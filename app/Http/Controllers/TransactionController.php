<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $data = Transaction::with(['customer', 'room'])->orderBy('created_at', 'DESC')->get();
        return responseApi(200, $data, 'List Data Transaction');
    }

    public function create(Request $request){
        if($request->query('check_in') && $request->query('check_out')){
            $startDate = Carbon::parse($request->query('check_in'));
            $endDate = Carbon::parse($request->query('check_out'));
            $listRoom = Transaction::select('room_id')
                            ->whereBetween('check_in', [$startDate, $endDate])
                            ->orWhereBetween('check_out', [$startDate, $endDate])
                            ->get()
                            ->pluck('room_id')
                            ->toArray();
            $room = Room::whereNotIn('id', $listRoom)
                    ->orderBy('name', 'ASC')
                    ->where('status', 'active')
                    ->get();
        }else{
            $room = Room::orderBy('name', 'ASC')
                    ->where('status', 'active')
                    ->get();
        }
        return responseApi(200, $room, 'List Data Avaiable Room');
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(),[ 
            'room_id' => 'required',
            'customer_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Add Data Transaction');
        }
 
        DB::beginTransaction();
        try{
            $startDate = Carbon::parse($request->check_in);
            $endDate = Carbon::parse($request->check_out);
            $checkRoomAvailability = Transaction::select('room_id')
                                    ->where('room_id', $request->room_id)
                                    ->whereBetween('check_in', [$startDate, $endDate])
                                    ->orWhereBetween('check_out', [$startDate, $endDate])
                                    ->get()
                                    ->pluck('room_id')
                                    ->toArray();
            if(count($checkRoomAvailability)){
                return responseApi(500, 'Error', 'Sorry the room that you want currently not avaiable');
            }
            $days = $startDate->diffInDays($endDate); 
            $request['total_price'] = Room::where('id', $request->room_id)->select('price')->value('price') * $days;
            $transaction = Transaction::create($request->all());
            do{
                $code = generateOrderNumber($transaction->id);
                $check_transaction = Transaction::where('code', $code)->first();
            }while($check_transaction);
            $transaction->update(['code' => $code]);
            DB::commit();
            return responseApi(200, $transaction, 'Data Transaction Added Successfully');
        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, 'Error', 'Fail To Add Data Transaction');
        }
    }

    public function show(Transaction $transaction) {
        return responseApi(200, $transaction, 'Detail Data Transaction');
    }

    public function update(Request $request, Transaction $transaction) {
        $validation = Validator::make($request->all(),[ 
            'status' => 'required',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Update Data Transaction');
        }

        DB::beginTransaction();
        try{
            $transaction->update($request->all());
            DB::commit();
            return responseApi(200, $transaction, 'Data Transaction Updated Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, 'Error', 'Fail To Update Data Transaction');
        }
    }

    public function update_payment(Request $request, Transaction $transaction) {
        $validation = Validator::make($request->all(),[ 
            'myimg' =>'required|mimes:jpeg,png|max:2048',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Update Data Transaction');
        }

        DB::beginTransaction();
        try{
            if ($request->hasFile('myimg')) {
                $request['img'] = updateImg('upload/admin/transaction/', $transaction->img);
            }
            $transaction->update(['img' => $request['img']]);
            DB::commit();
            return responseApi(200, $transaction, 'Data Transaction Payment Updated Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, 'Error', 'Fail To Update Data Transaction');
        }
    }

    public function destroy(Request $request, Transaction $transaction) {
        DB::beginTransaction();
        try {
            $transaction->delete();
            DB::commit();
            return responseApi(200, $transaction, 'Data Transaction Deleted Successfully');
        }catch(Exception $ex){
            DB::rollBack();
            return responseApi(500, 'Error', 'Fail To Delete Data Transaction');
        }
    }

}
