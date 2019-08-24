<?php


namespace App\Repositorio;

use App\User;
use Illuminate\Support\Str;
use Request;
class UserRepositori{

    public static function Create(string $name, string $email){
        $user = new User();
        $password_Tmp = Str::random(8);
        $pwd_encrypt = bcrypt($password_Tmp);
        $user->name = $name;
        $user->email = $email;
        $user->password = $pwd_encrypt;
        //save
        $user->save();
        //return user save
        return [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password_Tmp,
            'created_at' => $user->created_at->format('d/M/Y H:i')
        ];
    }

    public static function Update(string $name, string $email, int $id){
        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        //save
        return $user->Save();

    }

    public static function ResetPassword($user){
        $password_Tmp = Str::random(8);
        $pwd_encrypt = bcrypt($password_Tmp);
        $usuario = User::find($user);
        $usuario->password = $pwd_encrypt;
        //save
        $usuario->save();
        return [
            'name' => $usuario->name,
            'email' => $usuario->email,
            'password' => $password_Tmp,
            'updated_at' => $usuario->updated_at
        ];
    }


}