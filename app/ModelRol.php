<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelRol extends Model
{
    protected $table = "mrols";
    protected $primaryKey = "id_rol";
    protected $fillable = [
        'nom_rol', ];

    public function modulos(){
        return $this->belongsToMany('GaneshaSIGE\ModelModulo', 'mrol_mods',  'id_rol_trm',  'id_mod_trm');
        }

    public function usuarios(){
        return $this->belongsToMany('GaneshaSIGE\User', 'mrol_usus', 'id_rol_tru', 'id_tru');
    }
        public function tieneModulo($nom_mod){
        foreach($this->modulos as $modu)
            if($nom_mod == $modu->nom_mod)
                return true;
        return false;
    }
    public function tieneIdModulo($id_mod){
        foreach($this->modulos as $modu)
            if($id_mod == $modu->id_mod)
                return true;
        return false;
    }
}