<?php

namespace App\Helpers;

class Models
{
    static public function generateUid(\Illuminate\Database\Eloquent\Model $model, string $field = null): string
    {
        $uid = uniqid();
        while ($model::where($field ?? 'uid', '=', $uid)->count() > 0) {
            $uid = uniqid();
        }
        return $uid;
    }
}