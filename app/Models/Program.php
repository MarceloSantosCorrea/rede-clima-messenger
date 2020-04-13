<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use TraitUuid;

    protected $fillable = [
        'name', 'image', 'slogan', 'presenter', 'description', 'category',
    ];

    /**
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder|Model
     * @throws \Exception
     */
    public static function createCustom(Array $data)
    {
//        dd($data);
        try {
            \DB::beginTransaction();

            if ($model = self::query()->create($data)) {

                \DB::commit();

                return $model;
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param  array  $data
     * @param  Program  $model
     * @return Program
     * @throws \Exception
     */
    public static function updateCustom(Array $data, Program $model)
    {
        try {
            \DB::beginTransaction();
            $model->fill($data);

            if ($model->update()) {

                \DB::commit();

                return $model;
            }

        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }
}
