<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mplan_eva extends Model
{
    protected $fillable = [
        'id_plan', 'status', 'cod_sec_plan',	];
}
