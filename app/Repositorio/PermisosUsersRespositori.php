<?php


namespace App\Repositorio;

use App\User;
use DB;
use Caffeinated\Shinobi\Models\Role;



class PermisosUsersRespositori {


    public static function store(int $id_user, int $role )
    {
        $user = User::find($id_user);
        $rol  = Role::find($role);
        return $user->syncRoles($rol);

    }

    public static function getUsers(){
        $users = User::all();
        return $users;
    }

    public static function getUser($id){
        $user = User::where('id',$id)->get(['id','name','email'])->first();
        return $user;
    }

    public static function getUserRoles(int $id){
        $roles = DB::table('roles')
                     ->join('role_user','role_user.role_id','=','roles.id')
                     ->join('users','role_user.user_id','=','users.id')
                     ->where('users.id','=',$id)
                     ->get(['roles.id','roles.name','roles.description']);
        return $roles->toArray();
    }

    public static function getAllRoles()
    {
        $roles = Role::all('id','name','description');
        return $roles;
    }

    public static function destroy(int $id )
    {
        $user_obj = User::find($id);
        $roles = $user_obj->roles;
        $user_obj->removeRoles( $roles );

    }



}