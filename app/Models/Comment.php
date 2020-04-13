<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use TraitUuid;

    protected $fillable = ['comment', 'status', 'lead_id', 'created_at'];

    protected $with = ['lead'];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function getCreatedAtAttribute($value)
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
}
