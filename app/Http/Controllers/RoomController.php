<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryRoom;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function index(Request $request) {
        $data = Room::where('status', 'active')->orderBy('name', 'DESC')->get();
        return responseApi(200, $data, 'List Data Room');
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required|unique:rooms,name',
            'description' => 'required',
            'price' => 'required',
            'myimg' =>'required|mimes:jpeg,png|max:2048',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Add Data Room');
        }
 
        DB::beginTransaction();
        try{
            if ($request->hasFile('myimg')) {
                $img_name = insertImg('upload/admin/room/');
                $request['img'] = $img_name;
            }
            $room = Room::create($request->all());
            DB::commit();
            return responseApi(200, $room, 'Data Room Added Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, $room, 'Fail To Add Data Room');
        }
    }

    public function show(Room $room) {
        return responseApi(200, $room, 'Detail Data Room');
    }

    public function update(Request $request, Room $room) {
        $validation = Validator::make($request->all(),[ 
            'name' => 'required|unique:rooms,name,'. $room->id,
            'description' => 'required',
            'price' => 'required',
            'status' => 'required',
            'myimg' =>'nullable|mimes:jpeg,png|max:2048',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Add Data Room');
        }

        DB::beginTransaction();
        try{
            if ($request->hasFile('myimg')) {
                $request['img'] = updateImg('upload/admin/room/', $room->img);
            }
            
            $room->update($request->all());
            DB::commit();
            return responseApi(200, $room, 'Data Room Updated Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, 'Error', 'Fail To Update Data Room');
        }
    }

    public function destroy(Request $request, Room $room) {
        DB::beginTransaction();
        try {
            
            // deleteImg('upload/admin/room/', $room->img);

            $room->delete();
            DB::commit();
            return responseApi(200, $room, 'Data Room Deleted Successfully');
        }catch(Exception $ex){
            DB::rollBack();
            return responseApi(500, 'Error', 'Fail To Delete Data Room');
        }
    }

}
