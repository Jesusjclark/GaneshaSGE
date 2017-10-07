<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelModulo extends Model
{

    protected $table = "mmodulos";
    protected $primaryKey = "id_mod";
   	protected $fillable = ['id_mod','nom_mod',];

           public function roles1(){
        	return $this->belongsToMany('GaneshaSIGE\ModelRol', 'mrol_mods',  'id_mod_trm', 'id_rol_trm');
        }
} 