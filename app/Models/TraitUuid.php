<?php

namespace App\Models;

trait TraitUuid
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if (\Schema::hasColumn($item->getTable(), 'uid')) {
                $uid = uniqid();
                while (self::where('uid', '=', $uid)->count() > 0) {
                    $uid = uniqid();
                }
                $item->uid = $uid;
            }
        });
    }
}
