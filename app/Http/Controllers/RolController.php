<?php

namespace App\Http\Controllers;

use App\Helpers\InfoMenuHelper;
use App\Repositorio\PermisoRepositori;
use App\Repositorio\RolPermisosRepositori;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use DataTables;

class RolController extends Controller{

   public function index(){
       $info = InfoMenuHelper::InfoConnection();
       return view('administration.roles',compact('info'));
   }

   public function store(Request $request){
       if( $request->ajax() ){
           $this->validate( $request,[
               'name' => 'required|string',
               'slug' => 'required|string',
               'description' => 'required|string'
           ]);
           RolPermisosRepositori::store(
               $request->get('name'),
               $request->get('slug'),
               $request->get('description'),
               $request->get('special'),
               $request->get('permissions')
           );

           return response()->json('store');
       }
   }

   public function edit(Request $request,$id){
      if ( $request->ajax() ){
           $rol = RolPermisosRepositori::edit($id);
           return response()->json($rol);
      }
   }

   public function update(Request $request,$id){
       if ( $request->ajax() ){
           $this->validate( $request,[
               'name' => 'required|string',
               'slug' => 'required|string',
               'description' => 'required|string'
           ]);
           RolPermisosRepositori::update(
               $request->get('name'),
               $request->get('slug'),
               $request->get('description'),
               $request->get('special'),
               $request->get('permissions'),
               $id
           );
           return response()->json('update');

       }
   }

   public function destroy(Request $request,$id){
       if ( $request->ajax() ){
           if ( RolPermisosRepositori::delete($id) ){
               return response()->json('delete');
           }
       }
   }

   public function getAll(Request $request){
       if ( $request->ajax() ){
           $roles = RolPermisosRepositori::getAll();
           return DataTables::of($roles)->make(true);
       }

   }

   public function getRolPermissions (Request $request,Role $rol){
       if ( $request->ajax() ){
           $permissions = RolPermisosRepositori::getRolPermissions($rol->id);
           return response()->json($permissions);
       }
   }

   public function getAllPermission(Request $request){
       if ( $request->ajax() ){
           $permisos = PermisoRepositori::getAll()->get(['id','name','description']);
           return response()->json($permisos);
       }
   }

}
