<?php

namespace App\Http\Controllers\Graficos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\InfoMenuHelper;
use App\Grafico;

class GraficosListController extends Controller{

    public function index()
    {
        $info = InfoMenuHelper::InfoConnection();

        return view('grafico.list_graphic', compact('info'));
    }

    public function getAllGraphic(Request $request)
    {
        if ( $request->ajax() )
        {
            $user_id = auth()->id();

            $graficos = Grafico::WhereHas('dashboard', function ($query) use ( $user_id ){
                $query->where('user_id',$user_id);
            })->get();
            return  response()->json(['data' => $graficos]);
        }
    }

    public function delete(Request $request,$id){
        if ( $request->ajax() ){
            $delete = Grafico::find($id)->delete();
            return response()->json('delete');
        }
    }

}
