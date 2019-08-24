<?php

namespace App\Http\Controllers\Etl;


use App\Helpers\ExtractHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositorio\FileRepositori;

class ExtractController extends Controller {

      public function Extract(Request $request)
      {
          if ( $request->ajax() )
          {
              $this->validate($request, [
                  'schema'  => 'required|string',
                  'table'   => 'required|string',
                  'columns' => 'required|array',
                  'name_key'=> 'required|string',
              ]);

              $count = FileRepositori::existKey( $request->get('name_key') );

              if ( $count == 0 )
              {

                 // $TypeColumns = ExtractHelper::getTypeColumns( $request->get('schema'), $request->get('table'), $request->get('columns') );

                  $data = ExtractHelper::SelectData( $request->get('schema'), $request->get('table'), $request->get('columns') );

                 foreach ($data as $row ):

                     ExtractHelper::InsertCollectionMongo( (string) $request->get('name_key'), (array)  $row );

                 endforeach;

                 ExtractHelper::InsertTableMongoCollection( $request->get('name_key') );

                 return response()->json('store');
              }

              return response()->json('error_name');
          }
      }

      public function  CacheLista(Request $request)
      {
           if ( $request->ajax() ){

               $lista  = ExtractHelper::getListMongoCollection();

               return response()->json($lista);

           }
      }

}
