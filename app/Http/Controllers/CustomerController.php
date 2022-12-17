<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request) {
        $data = Customer::orderBy('name', 'ASC')->get();
        return responseApi(200, $data, 'List Data Customer');
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(),[ 
            'username' => 'required|unique:customers,username',
            'password' => 'required',
            'name' => 'required|unique:customers,name',
            'address' => 'required',
            'country' => 'required',
            'phone_number' => 'required|unique:customers,phone_number',
            'email' => 'required|unique:customers,email',
            'myimg' =>'required|mimes:jpeg,png|max:2048',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Add Data Customer');
        }
 
        DB::beginTransaction();
        try{
            if ($request->hasFile('myimg')) {
                $img_name = insertImg('upload/admin/customer/');
                $request['img'] = $img_name;
            }
            $customer = Customer::create($request->all());
            DB::commit();
            return responseApi(200, $customer, 'Data Customer Added Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, $customer, 'Fail To Add Data Customer');
        }
    }

    public function show(Customer $customer) {
        return responseApi(200, $customer, 'Detail Data Customer');
    }

    public function update(Request $request, Customer $customer) {
        $validation = Validator::make($request->all(),[ 
            'username' => 'required|unique:customers,username,' . $customer->id,
            'name' => 'required|unique:customers,name,'. $customer->id,
            'address' => 'required',
            'country' => 'required',
            'phone_number' => 'required|unique:customers,phone_number,'. $customer->id,
            'email' => 'required|unique:customers,email,'. $customer->id,
            'myimg' =>'nullable|mimes:jpeg,png|max:2048',
        ]);
        
        if ($validation->fails()) {
            return responseApi(500, $validation->errors(), 'Fail To Update Data Customer');
        }
        
        if($request->password){
            $validation = Validator::make($request->all(),[ 
                'password' => 'required',
            ]);
            
            if ($validation->fails()) {
                return responseApi(500, $validation->errors(), 'Fail To Update Data Customer');
            }
        }
        

        DB::beginTransaction();
        try{
            if ($request->hasFile('myimg')) {
                $request['img'] = updateImg('upload/admin/customer/', $customer->img);
            }
            
            if($request->password){
                $customer->update($request->all());
            }else{
                $customer->update($request->except(['password']));
            }
            DB::commit();
            return responseApi(200, $customer, 'Data Customer Updated Successfully');

        }catch(Exception $ex){
            DB::rollback();
            return responseApi(500, $customer, 'Fail To Update Data Customer');
        }
    }

    public function destroy(Request $request, Customer $customer) {
        DB::beginTransaction();
        try {
            $customer->delete();
            DB::commit();
            return responseApi(200, $customer, 'Data Customer Deleted Successfully');
        }catch(Exception $ex){
            DB::rollBack();
            return responseApi(500, $customer, 'Fail To Delete Data Customer');
        }
    }

}
