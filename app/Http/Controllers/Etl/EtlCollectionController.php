<?php

namespace App\Http\Controllers\Etl;

use App\Connect\Mongodb;
use App\Helpers\InfoMenuHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Repositorio\ETLHelper;



class EtlCollectionController extends Controller{

    public function index(){
       $info = InfoMenuHelper::InfoConnection();
       return view('datasource.etl_v2.Etl_Lista_Collection',compact('info'));
    }

    public function getRegisters(Request $request)
    {
        if( $request->ajax() )
        {
            $collections_mongo = ETLHelper::getCollectionsRegisters();

            return  DataTables::of($collections_mongo)->make(true);
        }
    }

    public function destroy(Request $request, Mongodb $mongodb, $id_key, $name_key)
    {
        if ( $request->ajax() )
        {
            if( $mongodb->Exist($name_key) )
            {
                if ( $mongodb->Drop($name_key) == 1 )
                {
                    ETLHelper::DeleteMongoCollection_pg($id_key);

                    return response()->json('delete');
                }
            }

        }
    }

    public function getInfo(Request $request,Mongodb $mongodb,$key){
       if( $mongodb->Exist($key) ){
           $info = $mongodb->getInfo($key);
       }
       return response()->json([
            'info' => $info
       ]);
    }


}
