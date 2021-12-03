<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Customer;

use DataTables,Auth;


class SalesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //store function
    public function store(Request $request){
        
        $response = $this->action($request);
        if (empty($request->type())){

            if($response['error_type'] == 'validation'){
                return redirect()->back()->withInput()->with('error', $response['message']);
            } else if($response['error_type'] == 'success'){
                return redirect('users')->with('success', $response['message']);
            }else{
                 return redirect()->back()->with('error', $response['message']);
            }
            
        }else{
            echo json_encode($response);
            die;
        }
    }
    
    public function action($request)
    {
        // create user 
        $validator = Validator::make($request->all(), [
            'name'     => 'required | string ',
            'phone'    => 'required | string',
            'city' => 'required',
            'address'     => 'required'
        ]);
        
        if($validator->fails()) {
            return array(
                'status'=> 0,
                'error_type'=> 'validation',
                'message' =>$validator->messages()->first()
            );

        }
        try
        {
            // store user information
            $user = Customer::create([
                        'name'     => $request->name,
                        'phone'    => $request->phone,
                        'city'    => $request->city,
                        'address'    => $request->address,
                        'add_by'    => 1,
                    ]);

            if($user){ 
                return array(
                    'status'=> 1,
                    'error_type'=> 'success',
                    'message' =>'New user created!'
                );
                
            }else{
                return array(
                    'status'=> 0,
                    'error_type'=> 'error',
                    'message' =>'Failed to create new user! Try again.'
                );
                
            }
        }catch (\Exception $e) {
            $bug = $e->getMessage();
            return array(
                    'status'=> 0,
                    'error_type'=> 'error',
                    'message' =>$bug
                );
        }
    }
}