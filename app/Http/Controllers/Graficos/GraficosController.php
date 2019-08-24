<?php

namespace App\Http\Controllers\Graficos;


use App\Connect\Mongodb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Mongo_Collection;
use App\Helpers\InfoMenuHelper;
use App\Helpers\GraficosHelper;
use App\Collection;
use App\Dashboard;
use App\Grafico;





class GraficosController extends Controller {


     public function index(){
         $info = InfoMenuHelper::InfoConnection();
         $collections = $this->GetKeyEtl();
         $operations = $this->getOperaciones();
         return view('grafico.content',compact('info','collections','operations'));
     }

     public function store(Request $request, Grafico $grafico){
          $validation = Validator::make($request->all(),[
              'key_data'  => 'required|string',
              'operation' => 'required|string',
              'dimension' => 'required|string',
              'medida' => 'required|string',
              'title_graphic' => 'required|string',
              'title_dataset' => 'required|string',
              'type' => 'required|string',
              'dashboard_id' => 'required|int'
          ]);
          if( $validation->fails() ){
             return response($validation->messages(), 200);
          }else{
             $grafico->key_data = $request->get('key_data');
             $grafico->operation = $request->get('operation');
             $grafico->dimension = $request->get('dimension');
             $grafico->medida = $request->get('medida');
             $grafico->title_graphic = $request->get('title_graphic');
             $grafico->title_dataset = $request->get('title_dataset');
             $grafico->type = $request->get('type');
             $grafico->dashboard_id = $request->get('dashboard_id');
             $grafico->save();
             return response()->json('store');
          }

     }

     public function GetEtl(Request $request,$key){
        if($request->ajax()) {
             $data = Mongodb::getColumnsCollection($key);
             $columns = !empty($data) ? array_keys($data) : [];
             return response()->json(
                 ['columns' => $columns]
             );
         }
     }

    private function GetKeyEtl()
    {   $user_id = Auth::id();
        return Mongo_Collection::where('user_id', $user_id)
                               ->get(['key'])->pluck('key')->toArray();
    }

    public function getData($collection,$dimension,$medida,$option,$type,$title,$datasetTitle){
        $data = GraficosHelper::OperacionesMongo($collection,$dimension,$medida,$option);
        $grafico = GraficosHelper::getGrafico( (array) $data, $type, $dimension, $medida, $title,$datasetTitle,$dimension,$medida);
        return response()->json(['grafico' => $grafico , 'data_table' =>  (array) $data ]);
    }

    private function getOperaciones(){
         $operaciones = Collection::where('type_id',3)
                                    ->get()->pluck('name')->toArray();
         return $operaciones;
    }


    public function getAllDashboard(Request $request)
    {
        if ( $request->ajax() )
        {
            $user_id = auth()->id();

            $data = Dashboard::where('user_id', $user_id)->get(['id', 'name']);

            return response()->json(['data' => $data]);
        }
    }

    public function getDescriptionDashboard($id){
        $data = Dashboard::where('id', $id)
                         ->get(['description'])->first();
        return response($data);
    }

}
