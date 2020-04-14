<?php

namespace App\Helpers;

class Models
{
    static public function generateUid(\Illuminate\Database\Eloquent\Model $model, string $field = null): string
    {
        $uid = \Str::uuid();
        while ($model::where($field ?? 'uid', '=', $uid)->count() > 0) {
            $uid = \Str::uuid();
        }
        return $uid;
    }
}