<?php

namespace GaneshaSIGE;

use Illuminate\Database\Eloquent\Model;

class ModelEvaluacion extends Model
{
   protected $table = "mevaluacions";
   protected $primaryKey = "id_eva";

   protected $fillable =[ 'unidad','id_plan_eva', 'id_inst_eva', 'criterio', 'observacion', 'fec_prop', 'fec_res', 'fec_part', 'participacion', 'corte', 'contenido',	'ponderacion'];

    public function Plan(){
    	return $this->belongsTo('GaneshaSIGE\ModelPlandeEvaluacion', 'id_eva', 'id_plan_eva');
    }

  
}
