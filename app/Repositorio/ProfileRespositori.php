<?php


namespace App\Repositorio;
use App\User;

class ProfileRespositori {

    public static function UpdatePassword(int $id,string $NewPassword){
        $user = User::find($id);
        $user->password = bcrypt($NewPassword);
        return $user->save();
    }

}