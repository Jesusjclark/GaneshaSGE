<?php

namespace GaneshaSIGE;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ModelSeccion extends Model
{
    protected $table = "mseccions";
    protected $primaryKey = "cod_sec";
    public $incrementing = false;

   protected $fillable = [ 'turno', 'trayecto',	];

//MasterPuente

    //de secciones a usuarios
    public function MasterPuente_Secc_User(){
        return $this->belongsToMany('GaneshaSIGE\User', 'mpuentemasters',  'cod_seccion','id_usu', 'cod_unidad', 'coordinador');
    }

    //de secciones a unidades
    public function MasterPuente_Secc_UniCrr(){
        return $this->belongsToMany('GaneshaSIGE\ModelUnidadCurricular', 'mpuentemasters',  'cod_seccion', 'cod_unidad', 'id_usu', 'coordinador');
    }
    
    public function unidades(){
         	return $this->belongsToMany('GaneshaSIGE\ModelUnidadCurricular', 'mpuentemasters',  'cod_seccion', 'cod_unidad');
        
    
    }
    public function tieneUC2($unidad,$secc){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('cod_seccion', $secc)->get(['cod_unidad']);
        $var2=count($var);
                if ($var2 >0) 
                return true;
        return false;
    }  
    public function notieneUC2($unidad,$secc){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('cod_seccion', $secc)->get(['cod_unidad']);
        $var2=count($var);
                if ($var2 >0) 
                return false;
        return true;
    }  
    
}
