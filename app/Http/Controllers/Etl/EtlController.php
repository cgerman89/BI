<?php

namespace App\Http\Controllers\Etl;


use App\Connect\Base;
use App\Helpers\InfoMenuHelper;
use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use DataTables;
use App\Http\Controllers\Controller;


class EtlController extends Controller {

     public function index(){
         $info = InfoMenuHelper::InfoConnection();
         return view('datasource.etl_v2.ETL',compact('info'));
     }

     public function HtmlTablePreview(Request $request, Builder $builder, $schema, $table){
          if($request->ajax()) {
             $columns = TableHelper::getColumns($schema, $table);
             $url_ajax = 'DBC/' . $schema . '/' . $table . '/getDataPreview';
             $parameters = ["destroy" => true, "paging" => false, "searching" => false, "ordering" => false , "autoWidth" => true, "scrollCollapse" => true, "scrollX" => true, "responsive" => true, "processing" => true, "serverSide" => true];
             $html = $builder->parameters($parameters)->columns($columns)->postAjax($url_ajax)->addTableClass('table small table-responsive table-hover table-bordered');
             return response()->json([
                 'table' => $html->table()->toHtml(),
                 'table_js' => $html->generateScripts()->toHtml()
             ]);
          }
     }






}
