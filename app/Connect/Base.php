<?php
/**
 * Created by PhpStorm.
 * User: andean
 * Date: 01/06/18
 * Time: 10:02
 */

namespace App\Connect;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Connection;

class Base {

    /**
     * @var \Illuminate\Database\Connection
     */
     private static $connection;


    /**
     * @var array
     */
     private static $dataType;



      public  static function GetRegister(){
          $connection = Connection::with('Collection:id,name')
                       ->where("id","=",Session('id_conn2'))
                       ->get()->first();
         if(empty($connection)== false){
             self::CreateConnection(
                 $connection->Collection->name,
                 $connection->host,
                 $connection->username,
                 $connection->dbname,
                 $connection->dbpassword,
                 $connection->port);
         }
     }

     private static function CreateConnection($tipo, $host, $username, $dbname, $dbpassword, $port){
        if(!empty($tipo)) {
            switch ($tipo) {
                case 'MYSQL':
                    $driver = ['driver' => 'mysql', 'host' => $host, 'port' => $port, 'database' => $dbname, 'username' => $username, 'password' => $dbpassword, 'unix_socket' => '', 'charset' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'prefix' => '', 'strict' => true, 'engine' => null];
                    config::set('database.connections.mysql', $driver);
                    self::$connection = DB::connection('mysql');
                    break;
                case  'POSTGRES';
                    $driver = ['driver' => 'pgsql', 'host' => $host, 'port' => $port, 'database' => $dbname, 'username' => $username, 'password' => $dbpassword, 'charset' => 'utf8', 'prefix' => '', 'sslmode' => 'prefer'];
                    config::set('database.connections.pgnew', $driver);
                    self::$connection =  DB::connection('pgnew');
                    break;
                case  'SQL SERVER':
                    $driver = ['driver' => 'sqlsrv', 'host' => $host, 'port' => $port, 'database' => $dbname, 'username' => $username, 'password' => $dbpassword, 'charset' => 'utf8', 'prefix' => ''];
                    config::set('database.connections.sqlsrv2', $driver);
                    self::$connection = DB::connection('sqlsrv2');
                    break;
            }
        }
    }

    /**
     * Get a table from the on the fly connection.
     *
     * @var    string $table
     * @return \Illuminate\Database\Query\Builder
     */
    private  static function getTable($table = null){
        return self::GetConnection()->table($table);
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    private static  function GetConnection(){
            return self::$connection;
    }

    /**
     * @return Collection|null
     */
    public static function GetSchemas(){
            if(self::GetConnection()!==null) {
                if (self::GetConnection()->getDriverName() == 'pgsql') {
                    return self::getTable('pg_catalog.pg_namespace')
                           ->where('nspname', 'not like', 'pg%')
                           ->where('nspname', '<>', 'information_schema')
                           ->get(['nspname as schema_name']);
                } elseif (self::GetConnection()->getDriverName() == 'sqlsrv') {
                    return self::getTable('INFORMATION_SCHEMA.TABLES')
                           ->where('TABLE_TYPE','=','BASE TABLE')
                           ->groupBy('TABLE_SCHEMA')->get(['TABLE_SCHEMA as schema_name']);
                } elseif (self::GetConnection()->getDriverName() == 'mysql') {
                    return null;
                }
            }
    }

    public static function GetTables($schema = null){
        if(self::GetConnection()!==null) {
            if (self::GetConnection()->getDriverName() == 'pgsql') {
                return self::getTable('pg_catalog.pg_tables')
                       ->where('schemaname','=',$schema)
                       ->get(['tablename as table_name']);
            }elseif (self::GetConnection()->getDriverName() == 'mysql') {
               return self::getTable('information_schema.TABLES')
                      ->where('TABLE_SCHEMA','=',self::getDbname())
                      ->get(['TABLE_NAME as table_name']);
            }elseif (self::GetConnection()->getDriverName() == 'sqlsrv'){
                return self::getTable('INFORMATION_SCHEMA.TABLES')
                       ->where('TABLE_SCHEMA','=',$schema)
                       ->orderBy('TABLE_NAME')
                       ->get(['TABLE_NAME as table_name']);
            }
        }
    }

    /**
     * @param $schema
     * @param $table
     * @return Collection
     */
    public static function GetRowsTable($schema,$table){
         if(self::StateConnection()){
                $driver = self::GetConnection()->getDriverName();
                switch ($driver){
                    case 'mysql':
                           return self::getTable($table)->get();
                        break;
                    case 'pgsql':
                          return self::getTable("$schema.$table")->get();
                        break;
                    case  'sqlsrv':
                        return self::getTable($schema.'.'.$table)->get();
                        break;
                }
         }
    }

    /**
     * @param $schema
     * @param $table
     * @param $columns
     * @return Collection
     */
    public static function getRegistros($schema,$table, array $columns = []) {
        if(self::StateConnection()) {
            $driver = self::GetConnection()->getDriverName();
            switch ($driver) {
                case 'mysql':
                    return self::getTable($table)->get($columns);
                    break;
                default:
                    return self::getTable($schema.'.'.$table)->get($columns);
                    break;
            }
        }
    }

    /**
     * @param $schema
     * @param $table
     * @param int $limit
     * @return Collection
     */
    public static function getRowsPreview($schema,$table, int $limit = 5){
        if(self::StateConnection()) {
            $driver = self::GetConnection()->getDriverName();
            switch ($driver) {
                case 'mysql':
                    return self::getTable($table)->select("*")->limit($limit)->get();
                    break;
                default:
                    return self::getTable("$schema.$table")->select("*")->limit($limit)->get();
                    break;
            }
        }
    }

    /**
     * @param $schema
     * @param $table
     * @return Collection
     */
    public static function GetColumnsTable($schema,$table){
        if(self::StateConnection())
        {
            $driver = self::GetConnection()->getDriverName();
            switch ($driver){
                case 'mysql':
                    return self::getTable('INFORMATION_SCHEMA.COLUMNS')
                                ->where('COLUMNS.TABLE_SCHEMA','=',self::GetDbname())
                                ->where('COLUMNS.TABLE_NAME','=',$table)
                                ->get(['COLUMN_NAME as columns']);
                    break;
                case 'pgsql':
                    return self::getTable('information_schema.columns')
                          ->where('table_schema','=',$schema)
                          ->where('table_name','=',$table)
                          ->get(['column_name as columns']);
                    break;
                case  'sqlsrv':
                    return self::getTable('INFORMATION_SCHEMA.COLUMNS')
                        ->where('TABLE_SCHEMA','=',$schema)
                        ->where('TABLE_NAME','=',$table)
                        ->get(['COLUMN_NAME as columns']);
                    break;
            }
        }
    }


    /**
     * @param $schema string
     * @param $table string
     * @param $columns array
     * @return Collection
     */
    public static function getColumnsType( $schema, $table, $columns){
        if(self::StateConnection())
        {
            $driver = self::GetConnection()->getDriverName();
            switch ($driver){
                case 'mysql':
                    return self::getTable('INFORMATION_SCHEMA.COLUMNS')
                        ->where('COLUMNS.TABLE_SCHEMA','=', self::GetDbname())
                        ->where('COLUMNS.TABLE_NAME','=', $table)
                        ->whereIn('COLUMN_NAME', $columns)
                        ->get(['COLUMN_NAME as column','DATA_TYPE as type'])->pluck('type','column');
                    break;
                case 'pgsql':
                    return self::getTable('information_schema.columns')
                        ->where('table_schema','=', $schema)
                        ->where('table_name','=', $table)
                        ->whereIn('COLUMN_NAME', $columns)
                        ->get(['column_name as column','DATA_TYPE as type'])->pluck('type','column');
                    break;
                case  'sqlsrv':
                    return self::getTable('INFORMATION_SCHEMA.COLUMNS')
                        ->where('TABLE_SCHEMA','=',$schema)
                        ->where('TABLE_NAME','=',$table)
                        ->whereIn('COLUMN_NAME', $columns)
                        ->get(['COLUMN_NAME as column','DATA_TYPE as type'])->pluck('type','column');
                    break;
            }
        }
    }


    /**
     * @return string
     */
    public static function GetDbname(): string {
        if(self::StateConnection())
                return self::GetConnection()->getDatabaseName();
    }

    /**
     * @return string
     */
    public  static function GetDBMS():string {
        if(self::StateConnection())
             if(self::GetConnection()->getDriverName() == 'pgsql'){
                  return 'POSTGRES';
             }elseif (self::GetConnection()->getDriverName() == 'mysql'){
                 return 'MYSQL';
             }elseif (self::GetConnection()->getDriverName() == 'sqlsrv'){
                 return 'SQL_SERVER';
             }else{
                return null;
             }
    }


    public static function StateConnection(){
        try{
            self::GetRegister();
            if ( !is_null(self::$connection))
                return self::$connection->getPdo();
        }catch (\Exception $e){
            Session()->forget('id_conn2');
            \Log::error('Error no connect en class base state'.$e->getMessage());
        }
    }

    /**
     * @return bool
     */
    public static function Disconnect(){
           dd(Session());
         if( !empty(Session('id_conn2'))) {
             Session()->forget('id_conn2');
             return true;
         }else{
             return false;
         }
    }
}