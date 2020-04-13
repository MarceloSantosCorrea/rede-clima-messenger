<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public $timestamps   = false;

    protected $fillable = [
        'option_name', 'option_value',
    ];

    /**
     * @param  string  $key
     * @return bool
     */
    public static function checkIfExists(string $key): bool
    {
        return (bool) self::query()->where(['option_name' => $key])->first();
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        $data = self::all();

        if ($data->count()) {
            $arr = [];
            foreach ($data as $item) {
                $arr[$item['option_name']] = $item['option_value'];
            }

            return $arr;
        }
        return [];
    }

    /**
     * @param  string  $key
     * @return string
     * @throws Exception
     */
    public static function get(string $key): string
    {
        if ($data = self::query()->where(['option_name' => $key])->first()) {
            return (string) $data->option_value;
        } else {
            throw new Exception('key not found');
        }
    }

    /**
     * @param  string  $key
     * @param  string  $value
     * @return bool
     * @throws Exception
     */
    public static function set(string $key, string $value = null): bool
    {
        if (! self::checkIfExists($key)) {
            return self::query()->create([
                'option_name'  => $key,
                'option_value' => $value,
            ]) ? true : false;
        } else {
            throw new Exception('key already exists');
        }
    }

    /**
     * @param  string  $key
     * @param  string  $value
     * @return bool
     * @throws Exception
     */
    public static function put(string $key, string $value = null): bool
    {
        if ($row = self::query()->where(['option_name' => $key])->first()) {

            $row->option_value = $value;
            return $row->save();
        } else {
            throw new Exception('key not found');
        }
    }
}
