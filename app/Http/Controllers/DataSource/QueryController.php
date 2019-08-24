<?php

namespace App\Http\Controllers\DataSource;

use App\Connect\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Alert;
use Illuminate\Support\Facades\DB;
use App\ETL\ProcessEtl;
use App\Helpers\InfoMenuHelper;



class QueryController extends Controller{
     private  $parametres = ["autoWidth" => true, "scrollX" => true,"scrollY" => 300];


    function index(){
        $info = InfoMenuHelper::InfoConnection();
        $transformer = DB::table('collections')->where('type_id','=',2)->get(['name'])->toArray();
        return view('datasource.query.query',compact('Schemas','Tables','transformer','info'));
    }

    function  ConnDb($id){
        if(empty(Session('id_conn2'))) {
            session(['id_conn2' => $id]);
            Session()->save();
            Base::GetRegister();
            Base::StateConnection();
        }
    }

    function  Disconnect(){
         Base::Disconnect();
         alert()->success('Disconnect')->autoclose(3500);
         return redirect('/Connections');
    }

    function GetTables($schema){
             Base::GetRegister();
             $tables = Base::GetTables(trim($schema));
             return $tables;
    }

    function  GetRowsTable(Request $request,Builder $htmlBuilder,DataTables $dataTables){
            $this->validate($request,['tables'=>'required|string']);
            $schema = $request->input('schemas');
            $table = $request->input('tables');
            Base::GetRegister();
            if ($dataTables->getRequest()->ajax()) {
               return $dataTables->collection(Base::GetRowsTable(trim($schema), trim($table)))->make(true);
            }
            $dbname = Base::StateConnection()? Base::GetDbname() : '';
            $dbms = Base::StateConnection()? Base::GetDBMS() : '';
            $columns = Base::StateConnection()? Base::GetColumnsTable(trim($schema),trim($table))->pluck('columns')->toArray():[];
            $Schemas = !empty(Base::GetSchemas())? Base::GetSchemas()->pluck('schema_name','schema_name') :[];
            $transformer = DB::table('collections')->where('type_id','=',2)->get(['name'])->toArray();
            $Tables  = !empty($schema)? $this->GetTables($schema)->pluck('table_name','table_name'):
                           Base::GetTables()->pluck('table_name','table_name');
                $html =  Base::StateConnection()?
                    $htmlBuilder->columns($columns)
                    ->parameters($this->parametres)
                    : null;
            return response()->view('datasource.query.query',compact('html','Schemas','Tables','dbname','dbms','table','schema','columns','transformer'));
    }

    function TransformerData(Request $request, ProcessEtl $processEtl,$schema,$table,$operation,$fields){
          if ( $request->ajax() ){
                Base::GetRegister();
                $rows = Base::GetRowsTable(trim($schema),trim($table));
                $data = json_decode($rows,true);
                $columns = explode(',',$fields);
                $result = $processEtl::Transformer($data, $operation, $columns);
                $keys = array_keys($result[0]);
                return response()->json([
                    'data' => $result,
                    'keys' => $keys,
                ]);
          }
    }


}
