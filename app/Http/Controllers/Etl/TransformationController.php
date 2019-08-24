<?php

namespace App\Http\Controllers\Etl;


use App\Connect\Mongodb;
use App\Helpers\InfoMenuHelper;
use App\Helpers\ExtractHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;


class TransformationController extends Controller {
     private  $parameters = ["destroy" => true, "autoWidth" => false, "scrollCollapse" => true, "scrollX" => false, "responsive" => true, "processing" => true, "serverSide" => true];


     public function index(){
         $info = InfoMenuHelper::InfoConnection();
         return view('datasource.etl_v2.Transformer',compact('info'));
     }

     public function ColumnsDataCache($key){
        $data = Mongodb::getColumnsCollection($key);
        return  array_keys( $data );
     }

     public function TransformerData(Request $request)
     {
         if ( $request->ajax()  ){
             $data = $request->all();
             foreach ($data as $row):
                 $result =  ExtractHelper::ProcessData($row['Data'],$row['Operations'],$row['Campos']);
                 foreach ($result as $res):
                     Mongodb::UpdateDataCollection( $row['Data'] , $res);
                 endforeach;
             endforeach;
             return response()->json(true);
         }

    }

}
