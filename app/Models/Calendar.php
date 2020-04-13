<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use TraitUuid;

    protected $fillable = [
        'start_at', 'week_day', 'program_id',
    ];

    protected $casts = [
        'start_at' => TimeCast::class,
    ];

    public function getStartAtAttribute($value)
    {
        try {
            $dt = new \DateTime($value, new \DateTimeZone("UTC"));
        } catch (\Exception $e) {
            print_r($e->getMessage());
            exit;
        }
        $dt->setTimeZone(new \DateTimeZone('America/Sao_Paulo'));

        return $dt;
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public static function getCalendars()
    {

        $data = self::orderBy('week_day')->orderBy('start_at')->get();
        $calendars = [
            "Dom" => [],
            "Seg" => [],
            "Ter" => [],
            "Qua" => [],
            "Qui" => [],
            "Sex" => [],
            "Sáb" => [],
        ];

        if ($data->count()) {
            /** @var \App\Models\Calendar $item */
            foreach ($data as $item) {

                $calendars[array_keys($calendars)[$item->week_day]][] = [
                    'start_time'  => $item->start_at->format('H:i'),
                    'uid'         => $item->uid,
                    'name'        => $item->program->name,
                    'slogan'      => $item->program->slogan,
                    'description' => $item->program->description,
                    'presenter'   => $item->program->presenter,
                    'category'    => $item->program->category,
                ];
            }
        }

        return array_filter($calendars);
    }

    /**
     * @param  array  $data
     * @return \Illuminate\Database\Eloquent\Builder|Model
     * @throws \Exception
     */
    public static function createCustom(Array $data)
    {
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
     * @param  Calendar  $model
     * @return Calendar
     * @throws \Exception
     */
    public static function updateCustom(Array $data, Calendar $model)
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
