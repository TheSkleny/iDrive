<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{
    // Asi taky nepotřebujeme, stačí users s query params
    public function getUsersByType($typeId) : array
    {
        return DB::select('
            select
            "U"."Id" as "UserId",
            "U"."name" as "UserName",
            "U"."email" as "UserEmail"
            from
            "users" as "U"
            where "U"."type_id" = :typeId
        ', ['typeId' => $typeId]);
    }
    public function getUsers() : array
    {
        return DB::select('
            select
            "U"."Id" as "UserId",
            "U"."name" as "UserName",
            "U"."email" as "UserEmail",
            "U"."type_id" as "UserTypeId",
            "UT"."Description" as "UserType"
            from
            "users" as "U"
            left join "UserType" as "UT"
            on "U"."type_id" = "UT"."Id"
        ');
    }
    public function getUser($userId)
    {
        return DB::select('
            select
            "U"."Id" as "UserId",
            "U"."name" as "UserName",
            "U"."email" as "UserEmail",
            "U"."type_id" as "UserTypeId",
            "UT"."Description" as "UserType"
            from
            "users" as "U"
            left join "UserType" as "UT"
            on "U"."type_id" = "UT"."Id"
            where "U"."Id" = :userId
        ', ['userId' => $userId]);
    }
    
    public function updateUserInfo($userId, $name, $email, $password, $typeId) : void
    {
        DB::update('
            update "users"
            set
                "name" = :name,
                "email" = :email,
                "password" = :password,
                "type_id" = :typeId
            where "Id" = :userId
        ', [
            'userId' => $userId,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'typeId' => $typeId
        ]);
    }
    public function deleteUser($userId) : void
    {
        DB::delete('
            delete from "users"
            where "Id" = :userId
        ', ['userId' => $userId]);
    }
}

