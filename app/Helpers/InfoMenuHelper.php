<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 31/08/18
 * Time: 10:53
 */

namespace App\Helpers;


use App\Connect\Base;

class InfoMenuHelper {


    public static function InfoConnection(){
         Base::GetRegister();
         if(Base::StateConnection()) {
            $dbname = Base::GetDbname();
            $dbms = Base::GetDBMS();
         }else{
            $dbname = '';
            $dbms   = '';
         }
         return compact('dbname','dbms');
    }
}