<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Dashboard;
use App\Helpers\InfoMenuHelper;
class DashboardController extends Controller
{

    public function index()
    {
        $info = InfoMenuHelper::InfoConnection();
        return view('dashboard.create_dashboard', compact('info'));
    }

    public function store(Request $request, Dashboard $dashboard)
    {
        if ($request->ajax())
        {
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:150',
                'description' => 'required|max:150'
            ]);

            $dashboard->name = $request->get('name');
            $dashboard->description = $request->get('description');
            $dashboard->user_id = auth()->id();

            //save
            $dashboard->save();
            return response()->json('store');
        }
    }

    public function allDashboard(Dashboard $dashboard)
    {
        $user_id = auth()->id();

        $data = $dashboard::where('user_id', $user_id)
                          ->get(['id', 'name', 'description']);

        return response()->json(['data' => $data]);
    }

    public function edit(Dashboard $dashboard, $id)
    {
        $data = $dashboard::where('id', $id)->get(['id', 'name', 'description']);
        return response($data);
    }

    public function update(Request $request, $id)
    {
        if ( $request->ajax() )
        {
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:150',
                'description' => 'required|max:150'
            ]);

            $dashboard = Dashboard::findOrFail($id);

            $dashboard->name = $request->get('name');
            $dashboard->description = $request->get('description');
            $dashboard->user_id = auth()->id();

            //update
            $dashboard->save();

            return response()->json('update');
       }
    }

    public  function delete($id){
        $delete = Dashboard::find($id)->delete();
        return response()->json('delete');
    }

}
