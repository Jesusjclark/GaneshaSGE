<?php
namespace GaneshaSIGE;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use GaneshaSIGE\Notifications\InvoicePaid;
use GaneshaSIGE\Notifications\NewPost;
use GaneshaSIGE\Notifications\PlanCoordinadores;
use GaneshaSIGE\Notifications\RecuperarPass;
use GaneshaSIGE\Notifications\ModifPlanCoor;
use GaneshaSIGE\Notifications\ResetPassword;



use GaneshaSIGE\ModelPlandeEvaluacion;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";

    protected $primaryKey = "id";

    protected $fillable = [
       'ci_usu', 'name', 'ape_usu', 'email', 'password', 'tlf', 'img_perfil',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function planes(){
        return $this->hasMany('GaneshaSIGE\ModelPlandeEvaluacion', 'id_plan');
    }

    public function getNombreCompleto(){
        return $this->name." ".$this->ape_usu;
    }

    public function img_perfil(){
            
        return $this->img_perfil;
    }

      public function roles()
    {
        return $this->belongsToMany('GaneshaSIGE\ModelRol', 'mrol_usus', 'id_tru', 'id_rol_tru');
    }
      public function generateNotify(){
        try {



        $this->notify(new InvoicePaid($this));
        } catch (Exception $e) {
        }
    }
     public function generateNotifyPlan($busquedasec, $uni){
        try {
            //dd($uni,$busquedasec);
        $this->notify(new NewPost($this,$busquedasec,$uni));
        } catch (Exception $e) {
        }
    }
    public function generateNotifyPlanCor($user2,$busquedasec, $uni){
        try {
        $this->notify(new Plancoordinadores($this,$user2,$busquedasec,$uni));
        } catch (Exception $e) {
        }
    } 
    public function generateNotifyPlanModifCor($user2,$busquedasec,$uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst){
        try {
            //dd($EmailViejoInst[0]);
        $this->notify(new ModifPlanCoor($this,$user2,$busquedasec,$uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst));
        } catch (Exception $e) {
        }
    }
     public function generateNotifyPass(){
        try {
        $this->notify(new RecuperarPass($this));
        } catch (Exception $e) {
        }
    }
     public function MasterPuente_User_Plan(){
        return $this->belongsToMany('GaneshaSIGE\ModelPlandeEvaluacion', 'mpuentemasters',  'id_usu', 'id_plan', 'cod_seccion', 'coordinador');
    }
//Super Puente
    
    //de usuarios a unidades
    public function MasterPuente_User_UniCrr(){
        return $this->belongsToMany('GaneshaSIGE\ModelUnidadCurricular', 'mpuentemasters',  'id_usu', 'cod_unidad', 'cod_seccion', 'coordinador');
    }

    //de usuarios a secc
    public function MasterPuente_User_Secc(){
        return $this->belongsToMany('GaneshaSIGE\ModelSeccion', 'mpuentemasters',  'id_usu', 'cod_seccion', 'cod_unidad', 'coordinador');
    }
    public function tienerolesMod($var){
            foreach($this->roles as $role)
            if($role->tieneModulo($var))
                return true;  
        return false;

            
        
    }
   
    public function tieneroles($nom_rol){
        foreach($this->roles as $rol)
            if($nom_rol == $rol->nom_rol)
                return true;
        return false;
    }

    public function tieneUC($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->get(['cod_unidad']);
        $var2=count($var);
                if ($var2 >0) 
                return true;
        return false;
        }
          public function tieneUCCor($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->where('coordinador', 'TRUE')->get(['cod_unidad']);
        $var2=count($var);
                if ($var2 >0) 
                return true;
        return false;
        }

         public function notieneUC($unidad,$id){
        $var=DB::table('mpuentemasters')->where('cod_unidad', $unidad)->where('id_usu', $id)->get(['cod_unidad']);
        $var2=count($var);
                if ($var2 >0) 
                return false;
        return true;
        }
    public function sendPasswordResetNotification($token)
        {
            $this->notify(new ResetPassword($token));
        }
    //   public function plan()
    // {
    //     return $this->belongsToMany('GaneshaSIGE\ModelRol', 'm_plan', 'id_tru', 'id_rol_tru');
    // }
}
