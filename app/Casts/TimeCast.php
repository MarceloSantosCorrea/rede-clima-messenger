<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimeCast implements CastsAttributes
{
    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes)
    {
        try {
            $dt = new \DateTime($value, new \DateTimeZone('UTC'));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            exit;
        }
        $dt->setTimeZone(new \DateTimeZone('America/Sao_Paulo'));

        return $dt;
    }

    /**
     * @inheritDoc
     */
    public function set($model, string $key, $value, array $attributes)
    {
        try {
            $dt = new \DateTime($value, new \DateTimeZone('America/Sao_Paulo'));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            exit;
        }
        $dt->setTimeZone(new \DateTimeZone('UTC'));

        return $dt->format('H:i');

    }
}