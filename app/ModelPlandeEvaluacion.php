<?php

namespace GaneshaSIGE;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\Notifications\InvoicePaid;
use GaneshaSIGE\Notifications\NewPost;
use GaneshaSIGE\ModelPlandeEvaluacion;
use Illuminate\Database\Eloquent\Model;

class ModelPlandeEvaluacion extends Model
{
     use Notifiable;
    protected $table = "mplan_evas";
    protected $primaryKey = "id_plan";

    protected $fillable = [
        'id_plan', 'id_usu', 'status', 'cod_sec_plan',	];

   public function Evaluaciones(){ 
   	return $this->hasMany('GaneshaSIGE\ModelEvaluacion', 'id_plan', 'id_eva'); 
   } 

   public function secciones(){ 
   	return $this->hasMany('GaneshaSIGE\ModelEvaluacion'); 
	}
   public function MasterPuente_Plan_User(){
        return $this->belongsToMany('GaneshaSIGE\User', 'mpuentemasters',  'id_plan', 'id_usu', 'cod_unidad', 'coordinador');
    }

    public function responsible(){
        return $this->belongsTo('GaneshaSIGE\User', 'id_user');
    }

    public function generateNotifyPlan($id_plan){
        try {

        $this->notify(new NewPost($this, $id_plan));
        } catch (Exception $e) {
        }
    }
}
