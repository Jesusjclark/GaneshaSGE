<?php

namespace GaneshaSIGE\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelEstudiante;
use GaneshaSIGE\ModelPlandeEvaluacion;
use GaneshaSIGE\ModelNota;


class EmailNota extends Notification
{
    use Queueable;

    public function __construct($estudiante,$tipoevas,$ucname,$Notas,$Pond,$busquedasec)
    {
        $this->estudiante=$estudiante;
        $this->Nota=$Notas;
        $this->ucname=$ucname;
        $this->tipoeva=$tipoevas;
        $this->Pond=$Pond;
        $this->busquedasec=$busquedasec;

       
    
   }
    public function via($notifiable)
    {
        return ['mail'];
    }

public function toMail($notifiable)
    {
        $Notas = $this->Nota;
        $Ponde= $this->Pond;
        $tipoevas=$this->tipoeva;
        $property_info = "";
        $i=0;
        $o=1;
        $acum=0;
        $final=0;
        //dd($Notas);
                foreach($Notas as $notarecorr) {
            $notapaso = $notarecorr;
            $instrumentopaso= $tipoevas[$i];
            $Pondpaso=$Ponde[$i];
            $property_info = $property_info ."#".$o." ". $instrumentopaso .":<br><b>". $notapaso. "/". $Pondpaso. " pts</b> " . "\n";
            $acum=$acum+$notapaso;
            $final=$final+$Pondpaso;

            $i=$i+1;
            $o=$o+1;
            $condicion='';
        }
        $promedio=$acum *100/$final;
        
        if( $promedio> 60){
            $condicion='<center><big><br>¡Felicidades!<br> ¡Vas Aprobando, sigue así!</big> </center>';
        }else{
            $condicion='<center><big><br>¡Vas Reprobando!<br>¡Pero no te desanimes! ¡Hay que ponerele más ganas! ;)</big> </center>';
            
        }




        return (new MailMessage)
            ->greeting('¡Saludos '.$this->estudiante->nom_est.' '.$this->estudiante->ape_est.'!')
                    ->subject('¡Nueva Notificación de Notas!')
                    ->line('Ganesha -SIGE te informa que ya han asignado las Notas para la Unidad Curricular: <b>'.$this->ucname[0].'</b><br>De la Sección <b>'.$this->busquedasec[0]->cod_sec.'</b><br> Del Turno de la: <b>'.$this->busquedasec[0]->turno.'</b>,  Has logrado obtener las siguientes calificaciones: </b>')
                    ->line(nl2br($property_info))
                    ->line("<b>Y tienes un puntaje total de: <b><big><big><u>".nl2br($acum)."/".($final)." pts</big></big> pts</u><br>".$condicion."")
                    
                    ->action('Ir a Ganesha-SIGE', 'Evaluaciónes Corregidas');
           
                    
    }
    

   
    public function toArray($notifiable)
    {
        return [
         
        ];
    }
}
