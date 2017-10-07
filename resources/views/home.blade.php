@extends('layouts.app')

@section('content')

 <section class="content">
    <div class="row">        
      	<div class="col-md-4 col-md-offset-1">
            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4 class="title">Bienvenido al Sistema GANESHA [SIGE]</h4>
                </div>
                <div class="card-content">
			        	<hr>
				            <p class="justify">
				            	<b> GANESHA [SIGE]  Es un sistema web desarrollado para la Gestion de las actividades académicas que se ejecutan dentro de la Universidad Politécnica Territorial de Lara "Andrés Eloy Blanco", como el control y creación del plan de evaluaciones,  transcipción y asignación de notas, así como el manejo de permisologías del cuerpo docente por Roles de Usuarios</b>
				            </p>
				        <hr>
			            <p class="justify">
			            	<em><b>Para mayor información diríjase al módulo de contacto donde podra solicitar asistencia para el uso del Sistema Ganesha [SIGE]</em></b>
			            </p>
			            <p>Documentación referente:</p>
				            <center>
				            	<a target="_blank" href="docs/Manual de Usuario.pdf" class="btn btn-primary" id="menu-toggle"> Manual <br> de Usuario</a> 
				                <a target="_blank" href="docs/RgInterno.pdf" class="btn btn-primary" id="menu-toggle">
				                	Reglamento <br> Interno UPTAEB
				                </a> 
				                <a target="_blank" href="docs/RgEva.pdf"  class="btn btn-primary" id="menu-toggle">
				                	Reglamento Interno de Evaluacion <br> del Rendimiento Estudiantil
				                </a>
				            </center>
                	</div>{{--FIN CARDCONTENT--}}
  				</div>{{--FIN CARD--}}
			</div>{{--FIN COL--}}

	
			
			<div class="col-md-5 col-md-offset-1">

				<div class="card">
				    <div class="card-header" data-background-color="blue">
				        <h4 class="title">Panel de Notificaciones</h4>
				    </div>
				<div class="card-content">
				<div class="box">

	            <div class="box-header with-border">
	              <h3 class="box-title">Mis Planes</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive">
	              <table class="table table-bordered">
	             @if(isset($Planes))
			            
			              @foreach($Planes as $plan)
			            
			                <tr>
			            
			                  <th>Plan</th>
			                  <th>Unidad</th>
			                  <th>Seccion</th>
			                  <th>Status</th>
			                  
			                  <th style="width: 30px">Progreso</th>
			                  <th style="width: 2px">%</th>

			                </tr>
			                <tr>
			                  	<td>
			                  		<b>
										{{$plan['Plan']}}
									</b>
								</td>
			                  	<td>
				                  	<b>
										{{$plan['unidad']}}
									</b>
								</td>
			                  	<td>
			                  		<b>
			                  			{{$plan['seccion']}}<br>
			                 		 	{{$plan['turno']}}
			                 		</b>
			                  	</td>
			                  
			                 

			                  
				                    @if($plan['status']=='FAIL')
					                    <td><b>FALLIDO </b></td>
					                    <td>
						                     <div class="progress progress-xs">
						                     	 <div class="progress-bar progress-bar-danger" style="width: {{$plan['porcentaje']}}%"></div>

						                    </div>
						                    </td>
						                   

						                     
						               

						                  	<td><span class="badge bg-red">{{$plan['porcentaje']}}%</span></td>
						            @else
						                    <td><b>{{$plan['status']}} </b></td>
						                    <td>	
							                <div class="progress progress-xs">
						                     	<div class="progress-bar progress-bar-green" style="width: {{$plan['porcentaje']}}%">
						                     		
						                    </div>
						                    </div>

						                    
						                       </td>
					                  <td><span class="badge bg-green">{{$plan['porcentaje']}}%</span></td>
			                    	@endif
			               @if(isset($Eva))
							                    @foreach($Eva as $eval)
							                    
								                    @if($eval['idpeva']==$plan['Plan'])
								                    	<tr>
								                    		<th>Eva.<br>Fallida</th>
								                    		<th>Unidad</th>

								                    		<th>Contenido</th>
								                    		<th>Tipo Eval</th>
								                    		<th>Fecha Prop.</th>
								                    		<th>Pond.</th>

								                    	</tr>
								                    	<tr>
								                    		<td>
								                    			<img style="display:auto;width: 100%; border: 0;max-width: 30px;max-height:50px; padding: 0px;" src="/img/iconos/16x16/exclamation-mark.png" width="10" height="10"/> 
								                    		</td>
								                    		<td>
								                    			<center><b>{{$eval['unidad']}}</center></b>
								                    		</td>
								                    		<td>
								                    			{{$eval['contenido']}}
								                    		</td>
								                    		<td>
								                    			{{$eval['instrumento']}}
								                    		</td>
								                    		<td>
								                    			{{$eval['fecha']}}
								                    		</td>
								                    		<td>
								                    			{{$eval['pond']}}pts
								                    		</td>
								                    	</tr>
								                    @else
								                    @endif
							                    @endforeach
						                    @endif
			                	</tr>
			            @endforeach
			            @else

			            <center><h2>Aun no posee ningún Plan Maestro/Asignado</h2>
			            <img style="display:auto;width: 100%; border: 0;max-width: 280px;max-height:280px; padding: 0px;" src="/img/elefante.jpg" width="10" height="10"></center>
	                @endif
	                
	             
	              </table>
	            </div>{{--FIN TABLA--}}
		        <!-- /.box-body -->
		        <div class="box-footer clearfix">
		          <ul class="pagination pagination-sm no-margin pull-right">
		            <li><a href="#">&laquo;</a></li>
		            <li><a href="#">1</a></li>
		            <li><a href="#">2</a></li>
		            <li><a href="#">3</a></li>
		            <li><a href="#">&raquo;</a></li>
		          </ul>
		        </div>

		   	 		
		      	</div>{{--FIN BOX--}}
		    </div>{{--FIN CARDCONTENT--}}
      </div>{{--FIN CARD--}}
	</div>{{--FIN COL--}}
</div>{{--FIN ROW--}}
</section>
		//@include('progreso')	
           

          <!-- /.box -->

    
@endsection
