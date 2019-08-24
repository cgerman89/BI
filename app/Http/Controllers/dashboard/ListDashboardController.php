<?php

namespace App\Http\Controllers\dashboard;

use App\Helpers\GraficosHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\InfoMenuHelper;
use App\Dashboard;
use App\Grafico;

class ListDashboardController extends Controller {


      public function index()
      {
          $info = InfoMenuHelper::InfoConnection();

          $dashboards = $this->getListDashboard();

          return view('dashboard.list_dashboard', compact('info','dashboards'));
      }

      public function getListDashboard()
      {
           $user_id = auth()->id();

           return Dashboard::where('user_id',$user_id)->get(['id','name']);

      }

      public function getGraphic($dashboard_id){

            if( !is_null($dashboard_id) ){

                $graficos = Grafico::where('dashboard_id',$dashboard_id)->get()->toArray();

                if ( empty($graficos) ){
                    return response()->json([]);
                }

                foreach ($graficos as $grafico):
                    $data[] = $this->createGraphic(
                        $grafico['key_data'],
                        $grafico['dimension'],
                        $grafico['medida'],
                        $grafico['operation'],
                        $grafico['type'],
                        $grafico['title_graphic'],
                        $grafico['title_dataset']
                    );
                endforeach;

                return response()->json($data);
            }
      }

      private function createGraphic($collection,$dimension,$medida,$option,$type,$title,$datasetTitle)
      {
          $data = GraficosHelper::OperacionesMongo($collection,$dimension,$medida,$option);
          $grafico = GraficosHelper::getGrafico( (array) $data, $type, $dimension, $medida, $title,$datasetTitle,$dimension,$medida);
          return $grafico;
      }


}
