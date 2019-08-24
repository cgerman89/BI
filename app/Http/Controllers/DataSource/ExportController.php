<?php

namespace App\Http\Controllers\DataSource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Connect\Base;
use App\Connect\Export;
use App\Helpers\InfoMenuHelper;

class ExportController extends Controller {

    public function index(){
        Base::GetRegister();
        $info = InfoMenuHelper::InfoConnection();
        $Schemas = !empty(Base::GetSchemas())? Base::GetSchemas()->pluck('schema_name','schema_name') :[];
        $Tables  = !empty(Base::GetTables())? Base::GetTables()->pluck('table_name','table_name') : [];
        return view('datasource.export.export',compact('info','Schemas','Tables'));
    }

    function GetTables($schema){
        Base::GetRegister();
        $tables = Base::GetTables(trim($schema));
        return $tables;
    }

    function Exportar(Request $request,$schema,$tables){
       $res= explode(',',$tables);
       Export::Select($schema,$res);

    }

}
