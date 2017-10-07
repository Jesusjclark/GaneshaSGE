 
 //función para validar correo de recuperrar contraseña
 function validarCorreo(){
  
  var corr=document.getElementById("correo").value;
  
  if (corr=="")
  {
    alert("[ERROR] revise bien los campo correo ");
    return false;
  }else{

    //vacio 
  }    
  
}

// funcion de registro de entrada salida exitoso o fallida
function campoObligatorio(){
  
  var ced=document.getElementById("cedula").value;
  var are=document.getElementById("area").value;
  var resp=document.getElementById("responsable").value;
  
  if (are=="" || resp==""){

    alert("Registro incompleto revisar casillas");
    return false;
  }else{
    
    alert("Registro exitoso");
  }
}

//funcion de cedula para consultar  persona 
function campoObligatorioBusP(){
  
  var ced=document.getElementById("cedula").value;
    
  if (ced==""){

    alert("Introdusca una cedula valida");
    return false;
  }else{
    
    alert("Consulta");
  }
}

// funcion de registro de empresa exitoso o fallida
function campoObligatorioEmpresa(){
  
  var rif=document.getElementById("rif").value;
  var nombE=document.getElementById("nombreEmpresa").value;
  var direc=document.getElementById("direccion").value;
  
  
  if (rif=="" || nombE=="" || direc==""){

    alert("Registro incompleto revisar casillas");
    return false;
  }else{
    
    alert("Registro exitoso");
  }
}

// funcion de modificar registro de empresa 
function campoObligatorioModEmp(){
  
  var rif=document.getElementById("rif").value;
  var nombE=document.getElementById("nombreEmpresa").value;
  var direc=document.getElementById("direccion").value;
  
  
  if (rif=="" || nombE=="" || direc==""){

    alert("[ERROR] verifique bien los datos");
    return false;
  }else{
    
    alert("Modificación exitoso");
  }
}

function campoObligatorioModPerf(){
  
  
  var usu=document.getElementById("usuario").value; 
  var contra=document.getElementById("contrasena").value;   
  var corr=document.getElementById("correo").value;
  var confNombUsu=document.getElementById("nombreUsuario").value;   
  
  
  if (usu=="" || contra=="" || corr=="" || confNombUsu==""){

    alert("[ERROR] Verifique bien los datos ");
    return false;
  }else{
    
    alert("Modificación exitoso");
  }
}

//funcion de rif  para consultar  empresa 
function campoObligatorioBusE(){
  
  var rif=document.getElementById("rif").value; 
  
  
  if (rif==""){

    alert("Porfavor ingrese un Rif ");
    return false;
  }else{
    
    alert("Consulta");
  }
}

function campoObligatorioBusPerf(){
  
  var usu=document.getElementById("usuario").value; 
  
  
  if (usu==""){

    alert("Porfavor ingrese un usuario ");
    return false;
  }else{
    
    alert("Consulta");
  }
}

//funcion para confirmar la cedula
function campoObligatorioBusCed(){
  
  var ced=document.getElementById("cedula").value;  
  
  
  if (ced==""){

    alert("Porfavor ingrese una Cedula");
    return false;
  }else{
    
    alert("Consulta");
  }
}

// funcion de registro de persona exitoso o fallida
function campoObligatorioPersona(){
  
  var ced=document.getElementById("cedula").value;
  var nombApe=document.getElementById("nombreApellido").value;
  var raz=document.getElementById("razonSocial").value;
  
  
  if (ced=="" || nombApe=="" || raz==""){

    alert("Registro incompleto revisar casillas");
    return false;
  }else{
    
    alert("Registro exitoso");
  }
}


// funcion buscar empresa para relacionarlo con la persona
function campoObligatorioBusEmp(){
  
  
  var raz=document.getElementById("razonSocial").value;
  
  
  if (raz==""){

    alert("Porfavor introduzca el nombre de la empresa");
    return false;
  }
}

// funcion de modificar registro de persona 
function campoObligatorioModPer(){
  
  var ced=document.getElementById("cedula").value;
  var nombApe=document.getElementById("nombreApellido").value;
  var raz=document.getElementById("razonSocial").value;
  
  
  if (ced=="" || nombApe=="" || raz==""){

    alert("[ERROR] verifique bien los datos");
    return false;
  }else{
    
    alert("Modificaión  exitoso");
  }
}

// funcion de imprimir el reporte exitoso o fallida
function campoObligatorioReporte(){
  
  var calDesde=document.getElementById("calendDesde").value;
  var calHasta=document.getElementById("calendHasta").value;  
  
  
  if (calDesde=="" ||calHasta==""){

    alert("[ERROR] Verifique los dato de la fecha ");
    return false;
  }else{
    
    alert("Proceso exitoso");
  }
}

// funcion para registar una ara con exito
function campoObligatorioAreas(){
  
  var area=document.getElementById("area").value;
  var jefe=document.getElementById("jefeArea").value; 
  var lugar=document.getElementById("lugarArea").value;
  
  
  if (area=="" || jefe=="" || lugar==""){

    alert("[ERROR] Verifique los dato del area ");
    return false;
  }else{
    
    alert("Registro exitoso");
  }
}

// funcion de creacion de esusrios con exito o fallido
function campoObligatorioPerfiles(){

  
  var usu=document.getElementById("usuario").value;
  var confUsu=document.getElementById("confUsuario").value;
  var contra=document.getElementById("contrasena").value;
  var confContra=document.getElementById("confContrasena").value; 
  var corr=document.getElementById("correo").value;
  var confCorr=document.getElementById("confCorreo").value;
  var confNombUsu=document.getElementById("nombreUsuario").value;   
  
  
  if (usu=="" || confUsu=="" || contra=="" || confContra=="" || corr=="" ||confCorr=="" || confNombUsu==""){

    alert("[ERROR] Verifique todos los datos bien ");
    return false;
  }else{

    if (usu==confUsu){
      if(contra==confContra){

        if (corr==confCorr){

          alert("Los datos se guardaron exitosamente");
        }else{

          alert("[ERROR] Los datos de CORREO no coinciden");
          return false;
        }


      }else{

      alert("[ERROR] Los datos de la CONTRASEÑA no coinciden");
      return false;

      }
          
  
    }else{

      alert("[ERROR] Los datos de USUARIO no coinciden");
      return false;
    }
    
    
  }
}

//función para poder decirle al usuario que debe tener un minimo de caracteres
function revisarLongitud(elemento, minimoDeseado){
  
  if (elemento.value!=""){
    
    var dato = elemento.value;
    if(dato.length < minimoDeseado){
      elemento.className = 'error';
      alert("El texto introducido es muy corto"); 
    }else{
      
      elemento.className = '';
    }
  }
}

//function confirmacionCedula(elemento){

//función para escribir solo numeros
function soloNumeros(elemento){
  
  key = elemento.keycode || elemento.which; // la variable key  almacena la entrada del teclado 

  teclado = String.fromCharCode(key);//almacena lo que lla en la entrda del teclado

  numeros = "0123456789";

  especiales = "46 || 8 || 37 || 39";//array

  tecladoEspecial = false;

  for ( var i in especiales){


    if (key==especiales[i]){
      tecladoEspecial = true;
    }

  }

  if (numeros.indexOf(teclado)==-1 && !tecladoEspecial){

    return false;
  }
}

//función para el tamaño de la cedula
function revisarLongitudCedula(elemento, minimoDeseado){
  
  if (elemento.value!=""){
    
    var dato = elemento.value;
    if(dato.length < minimoDeseado){
      elemento.className = 'error';
      alert(" [ERROR] la cantidad de caracteres de la cedula es muy corto");  
    }else{
      
      elemento.className = '';
    }
  }
}

//función para el tamaño de la Rif
function revisarLongitudRif(elemento, minimoDeseado){
  
  if (elemento.value!=""){
    
    var dato = elemento.value;
    if(dato.length < minimoDeseado){
      elemento.className = 'error';
      alert(" [ERROR] la cantidad de caracteres de la rif es muy corto"); 
    }else{
      
      elemento.className = '';
    }
  }
}

//función de pata poder escribir solo letras
 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }   

//función para salir al inicio de recepcionista 
function salir(){

  var pregunta = confirm("¿Desea salir de esta página?")
    if (pregunta){
      
      window.location="inicio.html";
    }else{
      
    }
}




//función para cancelar los datos 
function cancelar(){

  var pregunta = confirm("Está seguro de cancelar?");
}

//funcion para indicar que la casilla no tiene que quedar vacia
function revisarObligatorio(elemento){  
  
  if (elemento.value ==""){
    
    elemento.className = 'error';
    alert("Por favor debe llenar la casilla");
    
    
  }else{
    elemento.className ='';
  }
}

//función para revisar el área a la cual se dirije
function revisarArea(elemento){ 
  
  if (elemento.value =="")
  {
    elemento.className = 'error';
    alert("Indique el área a la cual se dirigue");
    return false;
  }
    else
    {
      elemento.className ='';
    }
}

//FUNCIÓN PARA CONVERTIR MINÚSCULAS A MAYÚSCULAS
function ponerMayusculas(elemento){
  
  elemento.value=elemento.value.toUpperCase();
}


//validación correcta de correo electronoco
function revisarEmail(elemento){
  
  
  if (elemento.value!=""){
    
    var dato = elemento.value;
    var expresion =/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    if(!expresion.test(dato)){
      elemento.className = 'error';
      alert("Error. el correo no fue escrito adecuadamente");
    }else{
      elemento.className = '';
    }
  }
  
}

