<?php

namespace App\Http\Controllers;

use App\Helpers\InfoMenuHelper;
use Illuminate\Http\Request;
use App\Repositorio\ProfileRespositori;

class ProfileController extends Controller {


    public function index(){
        $info = InfoMenuHelper::InfoConnection();
        return view('administration.perfil_usuario', compact('info'));
    }

    public function ChangePassword(Request $request){
        if ($request->ajax()){
            $this->validate($request,[
                'password' => 'required|string'
            ]);
            $user_id = auth()->id();
            if ( ProfileRespositori::UpdatePassword( (int) $user_id, (string) $request->get('password')) ){
                return response()->json('update');
            }
        }
    }


}
