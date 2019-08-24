<?php


namespace App\Repositorio;

use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use DB;

class RolPermisosRepositori {

      public static function store($name, $slug, $description, $special, $permissions = [] ){

              $role = new Role();
              $role->name = $name;
              $role->slug = $slug;
              $role->description = $description;
              $role->special = $special;
              //role save
              $role->save();
              // save permissions
              $role->permissions()->sync($permissions);
              return true;
      }

      public static function edit(int $id)
      {
          $rol = Role::findOrFail($id);
          $permissions = self::getIdsRolPermissions($id);
          return  compact('rol','permissions');
      }

      public static function update(string $name, string $slug, string $description, $special , array $permissions , int $id){
          $rol = Role::findOrFail($id);
          $rol->name = $name;
          $rol->slug = $slug;
          $rol->description = $description;
          $rol->special = $special;
          // save
          $rol->save();
          $rol->permissions()->sync($permissions);

          return true;
      }

      public static function delete( int $id){
          $rol = Role::findOrFail($id);
          return $rol->delete();
      }

      public static function getAll(){
          $roles = Role::all();
          return $roles;
      }

      /**
     * @param int $id
     * @return array
     */
      private static function getIdsRolPermissions(int $id){
         $permissions = DB::table('permissions')
                            ->join('permission_role','permissions.id','=','permission_role.permission_id')
                            ->join('roles','permission_role.role_id','=','roles.id')
                            ->where('roles.id',$id)
                            ->get(['permissions.id']);
         return $permissions->toArray();
      }

      public static function getRolPermissions( int $rol){
          $permissions = DB::table('permissions')
                             ->join('permission_role','permissions.id','=','permission_role.permission_id')
                             ->join('roles','permission_role.role_id','=','roles.id')
                             ->where('roles.id',$rol)
                             ->get(['permissions.id','permissions.name','permissions.description']);
          return $permissions->toArray();
      }

}