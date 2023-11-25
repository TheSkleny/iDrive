<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{
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
}

