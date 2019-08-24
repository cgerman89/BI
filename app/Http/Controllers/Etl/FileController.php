<?php

namespace App\Http\Controllers\Etl;

use App\ExcellFile\ExcellFile;
use App\Helpers\InfoMenuHelper;
use App\Helpers\ExtractHelper;
use App\Helpers\TableHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use App\Repositorio\FileRepositori;

class FileController extends Controller {

     public function index(){
         $info = InfoMenuHelper::InfoConnection();
         FileRepositori::ClearFileUpload();
         return view('datasource.etl_v2.File', compact('info'));
     }

     public function importFile(Request $request, Builder $builder){
            if ( $request->ajax() ) {

                 $request->validate([
                     'file' => 'required|file',
                 ]);

                 $extension =  File::extension( $request->file('file')->getClientOriginalName());

                 if ( ($extension == "csv") || ($extension == "xlsx") || ($extension == "xls") ){

                      $path = $request->file('file')->getRealPath();

                      $read_file = new ExcellFile();

                      ExtractHelper::ImportDataFile( $read_file, $path, $extension);

                      $table =  TableHelper::generateHmtlJsFile($builder);

                      $columns = TableHelper::getColumnsFile();

                      return response()->json( [
                                'table' => $table->table()->toHtml(),
                                'table_js' => $table->generateScripts()->toHtml(),
                                'columns' => $columns,
                                'file' => 'store'
                      ]);

                 }
            }

     }

     public function getData(Request $request){
         if ( $request->ajax() ){

             $data = ExtractHelper::getDataFile();

             return DataTables::of( $data )->make(true);

         }
     }

     public function store(Request $request){
         if ( $request->ajax() ){

              $request->validate([
                 'name_key' => 'required|string',
                 'columns'  => 'required|array'
              ]);

              $count = FileRepositori::existKey( $request->get('name_key') );

              if ( $count == 0 )
              {
                  FileRepositori::storeExtractFile( $request->get('name_key'), (array) $request->get('columns') );

                  FileRepositori::ClearFileUpload();

                  return response()->json('store');
              }

              return response()->json('error_name');
         }

     }





}
