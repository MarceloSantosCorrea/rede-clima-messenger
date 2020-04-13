<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use TraitUuid;
    
    protected $fillable = ['external_id', 'name', 'email', 'thumbnail'];
}
