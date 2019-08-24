<?php

namespace App\Http\Controllers\DataSource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConnectionStoreRequest;
use App\Connection as connections;
use App\Helpers\InfoMenuHelper;
use App\Connect\Base;
use DataTables;

class Connection extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $info = InfoMenuHelper::InfoConnection();
        return view('datasource.connection.conectar',compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConnectionStoreRequest $request){
         $user_id = auth()->id();
         $data = array_add( $request->all(),'user_id',$user_id);
         connections::create($data);
         return response()->json('Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = connections::where('id',$id)
            ->get(['collecction_id','host','username','dbname','dbpassword','port','id'])->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConnectionStoreRequest $request, $id){
        $connection = connections::find($id);
        if( !is_null($connection) ) {
            $connection->fill($request->all())->save();
            return response()->json('Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $delete = connections::find($id)->delete();
        return response()->json(['result' => $delete]);
    }

    /**
     * return register the connection
     * @return mixed
     */
    function get_data(){
        $connections = connections::with('Collection:id,name')->where("user_id","=",auth()->user()->id)->get();
        return DataTables::of($connections)->make(true);
    }

    public function Connect($id){
          session(['id_conn2' => $id]);
          Session()->save();
          $state = is_null(Base::StateConnection()) ? 'Error' : 'Success';
          return response()->json($state);
    }

    public function GetInfoConnect(){
        $info = InfoMenuHelper::InfoConnection();
        return response()->json($info);
    }
}
