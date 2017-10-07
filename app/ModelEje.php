<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelEje extends Model
{

    protected $table = "mejes";
    protected $primaryKey = "cod_eje";
   protected $fillable = ['nom_eje', 'descripcion',	];

           public function unidadesCurriculares(){
        	return $this->belongsToMany('GaneshaSIGE\ModelUnidadCurricular', 'mejes_ucs',  'cod_ejes_euc', 'cod_uc_pnf_euc');
        }
}
