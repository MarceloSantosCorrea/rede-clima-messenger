<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, TraitUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime',
    ];

    /**
     * @param  array  $data
     * @return User|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public static function createCustom(Array $data)
    {
        try {
            \DB::beginTransaction();
            $dataCreate             = $data;
            $dataCreate["password"] = bcrypt($dataCreate["password"]);

            if ($model = self::query()->create($dataCreate)) {

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
     * @param  User  $model
     * @return User
     * @throws \Exception
     */
    public static function updateCustom(Array $data, User $model)
    {
        try {
            \DB::beginTransaction();
            if (! empty($data['password'])) {
                $data["password"] = bcrypt($data["password"]);
            } else {
                unset($data['password']);
            }

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
