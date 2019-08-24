<?php


namespace App\Repositorio;

use Caffeinated\Shinobi\Models\Permission;
use DB;

class PermisoRepositori {

    public static function create(string $name, string $slug, string $description){
        $permission = new Permission();
        $permission->name = $name;
        $permission->slug = $slug;
        $permission->description = $description;
        //save
        return $permission->save();
    }

    public static function edit($id){
        $permiso = Permission::find($id);
        return $permiso;
    }

    public static function update(int $id, string $name, string $slug, string $description){
        $permiso = Permission::find($id);
        $permiso->name = $name;
        $permiso->slug = $slug;
        $permiso->description = $description;
        //save
        return $permiso->save();

    }

    public static function destroy( int $id){
        $permiso = Permission::find($id);
        return $permiso->delete();
    }

    public static function getAll(){
        return DB::table('permissions');
    }

}