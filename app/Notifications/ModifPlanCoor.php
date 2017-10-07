<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;

class ModifPlanCoor extends Notification
{
    use Queueable;

    public function __construct($user,$user2,$busquedasec, $uni,$EmailFecpart, $EmailFecprop,$EmailInst,$EmailObservacion,$EmailUnidad,$EmailViejoInst)
    {
        
        $this->EmailFecpart=$EmailFecpart;
        $this->EmailFecprop=$EmailFecprop;
        $this->EmailInst=$EmailInst;
        $this->EmailObservacion=$EmailObservacion;
        $this->user=$user;
        $this->busquedasec=$busquedasec;
        $this->uni=$uni;
        $this->docente=$user2;
        $this->EmailUnidad=$EmailUnidad;
        $this->EmailViejoInst=$EmailViejoInst[0];
        //dd($this->EmailViejoInst);
   }
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)

    {
        $EmailFecpart = $this->EmailFecpart;
        $EmailFecprop= $this->EmailFecprop;
        $EmailInst= $this->EmailInst;
        $EmailObservacion= $this->EmailObservacion;
       // dd($this->$EmailViejoInst);

        $EmailUnidad=$this->EmailUnidad;
        $EmailViejoInst=$this->EmailViejoInst;
       // dd($EmailViejoInst);    
        $property_info = "";
        $i=0;
        $o=1;
        foreach($EmailFecpart as $EmailFecparti) {
            $EmailFecpartpaso = $EmailFecparti;
            $EmailUnidadpaso=$EmailUnidad[$i];
            $EmailFecproppaso= $EmailFecprop[$i];
            $EmailInstpaso=$EmailInst[$i];
            $EmailViejoInstpaso=$EmailViejoInst;
            $EmailObservacionpaso=$EmailObservacion[$i];

            $property_info = $property_info ."<b># ".$o."</b> Anterior<b>: ". $EmailViejoInstpaso ."<br></b>Nueva><b>: ".$EmailInstpaso."<br></b> De la Unidad Nro: <b>".$EmailUnidadpaso."°  </b><br>Fecha Anterior: <b>". $EmailFecpartpaso. "</b><br>Nueva Fecha: <b>". $EmailFecproppaso."</b><br>Observación: <b>".$EmailObservacionpaso . "</b> </b><br> " . "\n";

            $i=$i+1;
            $o=$o+1;

        }

        //dd($this->EmailFecpart,$this->EmailFecprop,$this->EmailInst,$this->EmailObservacion,);
       
        return (new MailMessage)
       /* 'correo.plantilla_correo', ['invoice' => $this->uni]);*/

        
                    ->greeting('Saludos! '.$this->user->name.' '.$this->user->ape_usu.'')
                    ->subject('Notificación de Modificación de Planes de Evaluacion!')
                    ->line('Ganesha -SIGE le informa que el Plan de Evaluación de La Unidad Curricular <b>'.$this->uni[0].'</b><br>De la Sección <b>'.$this->busquedasec[0]->cod_sec.'</b><br> Turno: <b>'.$this->busquedasec[0]->turno.'</b> <br>Ha sufrido Cambios, Ya que el docente responsable: <b>'.$this->docente->name.' '.$this->docente->ape_usu.'</b>  Ha modificado las fechas/tipo de instrumento de las siguientes Evaluaciones:.')
                    ->line(nl2br($property_info))

                    ->action('Ir a Ganesha-SIGE', 'Datos de Planes Modificados')
           
                    ->line('Gracias por usar Ganesha-SIGE!');
                    
    }

   
    public function toArray($notifiable)
    {
        return [
         
        ];
    }
}
