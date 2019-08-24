<?php


namespace App\Repositorio;


use App\Dashboard;
use App\Connection;
use App\Mongo_Collection;
use DB;
use Auth;

class HomeRepositori {

    public static function getCountDashboardsGraphics()
    {
        $user_id = Auth::id();

        $countDashboard = self::getCountDashboards( (int) $user_id );

        $countGraphic = self::getCountGraphics(  (int) $user_id );

        $countConnection = self::getCountConnections( (int) $user_id );

        $countCollection = self::getCountCollections( (int) $user_id );


        return compact('countDashboard','countGraphic','countCollection','countConnection');
    }

    private static function getCountDashboards(  int $user_id )
    {
        $count = Dashboard::where('user_id',$user_id)->count();
        return $count;
    }

    private static function getCountGraphics( int $user_id )
    {
        $count = DB::table('grafico')
                    ->join('dashboard','grafico.dashboard_id','=','dashboard.id')
                    ->where('dashboard.user_id',$user_id)
                    ->count('grafico.id');
       return $count;
    }

    private static function getCountConnections( int $user_id)
    {
        return Connection::where('user_id',$user_id)->count();
    }

    private static function getCountCollections(int $user_id)
    {
        return Mongo_Collection::where('user_id',$user_id)->count();
    }





}