<?php

namespace GaneshaSIGE;
use Illuminate\Notifications\Notifiable;
use GaneshaSIGE\Notifications\EmailNota;

use Illuminate\Database\Eloquent\Model;

class ModelEstudiante extends Model
{
    use Notifiable;

 	protected $table = "mestudiantes";
    protected $primaryKey = "ci_est";
   	protected $fillable = [
        'nom_est', 'ape_est', 'cod_pnf_est', 'email'	];

 	public function generateNotifyNota($tipoeva,$ucname,$Nota,$Pond,$busquedasec){
        try {
        	
        $this->notify(new EmailNota($this,$tipoeva,$ucname,$Nota,$Pond,$busquedasec));
        } catch (Exception $e) {
        }
    }
}