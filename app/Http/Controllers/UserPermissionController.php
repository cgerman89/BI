<?php

namespace App\Http\Controllers;

use App\Helpers\InfoMenuHelper;
use Illuminate\Http\Request;
use DataTables;
use App\Repositorio\PermisosUsersRespositori;

class UserPermissionController extends Controller {

    public function index(){
        $info = InfoMenuHelper::InfoConnection();
       return view('administration.usuarios_permisos',compact('info'));
    }

    public function store(Request $request){
        if ( $request->ajax() ){
            $this->validate( $request,[
               'id' =>'required|int',
               'roles' => 'required|int'
            ]);

            PermisosUsersRespositori::store( (int)  $request->get('id'), (int) $request->get('roles') );

            return response()->json('store');
        }
    }

    public function showRoles(Request $request,$id){
       if ( $request->ajax() ){
            $roles = PermisosUsersRespositori::getUserRoles((int) $id);
            return response()->json($roles);
        }

    }

    public function destroy(Request $request,$id){
        if( $request->ajax() ){
            PermisosUsersRespositori::destroy( (int) $id);
            return response()->json('delete');
        }
    }

    public function getAllUsers(Request $request){
       if( $request->ajax() ){
           return DataTables::of( PermisosUsersRespositori::getUsers() )->make(true);
       }
    }

    public function getAllRoles(Request $request){
        if ( $request->ajax() ){
           $roles = PermisosUsersRespositori::getAllRoles();
           return response()->json($roles);
        }
    }

    public function getUser(Request $request,$id){
        if ( $request->ajax() ){
           $user = PermisosUsersRespositori::getUser($id);
           return response()->json($user);
        }
    }

}
