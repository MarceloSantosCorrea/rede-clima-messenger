<?php

namespace App\Models;

trait TraitUuid
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if (\Schema::hasColumn($item->getTable(), 'uid')) {
                $uid = \Str::uuid();;
                while (self::where('uid', '=', $uid)->count() > 0) {
                    $uid = \Str::uuid();;
                }
                $item->uid = $uid;
            }
        });
    }
}
