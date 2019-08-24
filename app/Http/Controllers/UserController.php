<?php

namespace App\Http\Controllers;

use App\Mail\PasswordTemporal;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Mail;
use App\Helpers\InfoMenuHelper;
use App\Repositorio\UserRepositori;
use App\User;
use DataTables;

class UserController extends Controller {

    public function index(){
        $info = InfoMenuHelper::InfoConnection();
        return view('administration.usuarios',compact('info'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email'
        ]);
        $data = UserRepositori::Create( $request->get('name'), $request->get('email') );
        Mail::to( $request->get('email') )->queue( new PasswordTemporal($data));
        return response()->json('store');
    }

    public function edit(Request $request,$id){
        if ( $request->ajax() ){
            $user = User::findOrFail($id);
            return response()->json($user);
        }
    }

    public function update(Request $request,$user){
        if ( $request->ajax() ) {
            $this->validate($request,[
                'name' => 'required|string',
                'email' => 'required|email'
            ]);
            if ( UserRepositori::Update($request->get('name'), $request->get('email'), $user)) {

                return response()->json('update');
            }
        }
    }

    public function destroy($user){
        $delete = User::find($user)->delete();
        return response()->json('delete');
    }

    public function getAllUsers(Request $request){
        if ( $request->ajax() ) {
            $users = User::all();
            return DataTables::of($users)->make(true);
        }
    }

    public function resetPassword(Request $request,$user){
            if ( $request->ajax() ){
                $data = UserRepositori::ResetPassword($user);
                Mail::to( $data['email'] )->queue( new ResetPassword($data) );
                return response()->json('reset');
            }
    }

}
