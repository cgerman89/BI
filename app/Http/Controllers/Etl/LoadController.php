<?php

namespace App\Http\Controllers\Etl;

use App\Helpers\InfoMenuHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\TableHelper;


class LoadController extends Controller {

    public function index(){
        $info = InfoMenuHelper::InfoConnection();
       return view('datasource.etl_v2.Load',compact('info'));
    }

    public  function getHtmlTable(Request $request, Builder $builder, $key)
    {
        if ( $request->ajax() )
        {
            $columns = TableHelper::getColumnsData($key);

            $parameters = ["destroy" => true, "autoWidth" => true, "scrollCollapse" => true, "scrollX" => true, "responsive" => true, "processing" => true, "serverSide" => true];

            $html = $builder
                ->parameters($parameters)
                ->columns($columns)
                ->Ajax(Route('load.getData', ['key' => $key]))
                ->addTableClass('table-condensed table-hover');
            return response()->json([
                'table' => $html->table()->toHtml(),
                'table_js' => $html->generateScripts()->toHtml()
            ]);
        }
    }

    public function getData(Request $request,$key){
        if($request->ajax()) {
            $collection = TableHelper::getAllData($key);
            return DataTables::of($collection->take(5000))->toJson();
        }
    }

    public function LoadData(Request $request,$schema,$table){

    }


}
