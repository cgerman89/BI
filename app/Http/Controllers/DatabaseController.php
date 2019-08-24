<?php

namespace App\Http\Controllers;

use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use App\Connect\Base;
use Illuminate\Support\Facades\DB;
use App\Collection;
use Yajra\DataTables\DataTables;

class DatabaseController extends Controller {

    public function GetSchemas(Request $request){
        if($request->ajax()){
            Base::GetRegister();
            $resp = Base::GetSchemas();
            return  response()->json(
                ['schemas'=>$resp]
            );
        }
    }

    public function GetTables(Request $request,$schema){
        if($request->ajax()){
            Base::GetRegister();
            $resp = Base::GetTables(trim($schema));
            return response()->json(
                ['tables' =>$resp]
            );
        }
    }

    public function GetColumns(Request $request,$schema,$table){
         if($request->ajax())
         {
             Base::GetRegister();
             $resp = Base::GetColumnsTable( trim($schema), trim($table));

             return response()->json(['columns' =>$resp]);
         }
    }

    public function GetOperation(Request $request){
        if($request->ajax()){
          $operation = DB::table('collections')
              ->where('type_id','=',2)->get(['name']);
          return response()->json(
                ['operation' =>$operation]
          );
        }
    }

    public function GetDBMS(){
        $collection = Collection::where("type_id","=",1)->pluck('name','id');
        return response()->json($collection);
    }

    public function getDataPreview(Request $request,$schema,$table){
        if($request->ajax()) {
            Base::GetRegister();
            $resp = Base::getRowsPreview($schema, $table);
            $data = TableHelper::ConvertirTitleData($resp);
            return DataTables::of($data)->make(true);
        }
    }


}
