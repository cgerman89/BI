<?php

namespace App\Http\Controllers;

use App\Helpers\InfoMenuHelper;
use Illuminate\Http\Request;
use App\Repositorio\PermisoRepositori;
use DataTables;

class PermisoController extends Controller {

    public function index(){
       $info = InfoMenuHelper::InfoConnection();
       return view('administration.permisos',compact('info'));
    }

    public function store(Request $request){
         if( $request->ajax() ){
             $this->validate($request,[
                 'name' => 'required|string',
                 'slug' => 'required|string',
                 'description' => 'required|string'
             ]);
             if ( PermisoRepositori::create( $request->get('name'),$request->get('slug'), $request->get('description') ) ){
                 return response()->json('store');
             }
         }
    }

    public function edit(Request $request, $id){
       if ( $request->ajax() ){
          $permiso = PermisoRepositori::edit($id);
          return response()->json($permiso);
       }
    }

    public function update(Request $request, $id){
        if ( $request->ajax() ){
            $this->validate($request,[
                'name' => 'required|string',
                'slug' => 'required|string',
                'description' => 'required|string'
            ]);
            if ( PermisoRepositori::update($id,$request->get('name'), $request->get('slug'), $request->get('description') ) ){
                return response()->json('update');
            }
        }
    }

    public function destroy(Request $request, $id){
        if ( $request->ajax() ){
            if ( PermisoRepositori::destroy($id) ){
                return response()->json('delete');
            }
        }
    }
    public function getAll(Request $request){
       if ( $request->ajax() ){
           $data = DataTables::of( PermisoRepositori::getAll() )->make();
           return $data;
       }
    }

}
