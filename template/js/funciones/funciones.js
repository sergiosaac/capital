//Funciones generales
function mostrar_formulario(mostrar,ocultar){
  $(mostrar).fadeToggle();
  $(ocultar).fadeToggle();
}

function format(input){
  console.log(input);
  var num = input.value.replace(/\./g,'');
  
  if(!isNaN(num)){
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      num = num.split('').reverse().join('').replace(/^[\.]/,'');
      input.value = num;
    }

    else{ alert('Solo se permiten numeros');
      input.value = input.value.replace(/[^\d\.]*/g,'');
  }
}



(function(){
  //Mensajes y alertas
  setTimeout(function(){  $('.alertas').fadeOut('slow');   }, 4000);

  $("#crear_vehiculo").submit(function(){
    $('.boton_crear').parent().append("<img src='http://i.stack.imgur.com/MnyxU.gif' height='30' width='30' >");
    
  });
  
   $(".nuevas_imagenes").submit(function(){

    $('.mas_imagenes').append("<img src='http://i.stack.imgur.com/MnyxU.gif' style='margin-left:10px;' height='30' width='30' >");
    
  });

  
  //Visor de imagenes
   $('.ver').click(function(event){     
     $('#visor-fotos-vehiculos').modal('show'); 
     $(".visor-grande").attr("src",event.currentTarget.src);       
   });  
  
  $(document).keyup(function(event){
        if(event.which==27)
        {
           $('#visor-fotos-vehiculos').modal('hide');  
        }
    });
  
  //ADMINSTRACION
  //AJAX VEHICULOS
  //BORRAR VEHICULO
   $('.eliminar').click(function(){
     
      if(confirm("Seguro que quieres borrar ?")){        
        //Recogemos la id del contenedor padre
        var parent = $(this).parent().parent().parent();
        //Recogemos el valor del servicio
        var service = $(this).attr('data');  
        console.log(service);
        var dataString = 'id='+service;
        $.ajax({
            type: "POST",
            url: "eliminar.vehiculo.php",
            data: dataString,
            success: function(server) {            
              //  $('#delete-ok').empty();
                //$('#delete-ok').append('<div>Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
                $(parent).fadeOut('slow');
              console.log(server);
            }
        });
        
      }    
    });   
  
  //BORRAR IMAGEN VEHICULOS
   $('.eliminar_imagen').click(function(){     
      if(confirm("Seguro que quieres borrar ?")){        
        //Recogemos la id del contenedor padre
      var parent = $(this).parent();
        //Recogemos el valor del servicio
        var service = $(this).attr('data');  
        var service2 = $(this).attr('data2');  
                          
        var dataString = 'id='+service+'&nombre='+service2;
        console.log(dataString);   
        $.ajax({
            type: "POST",

            url: "eliminar.imagen.vehiculos.php",
            data: dataString,
            success: function(server) {            
              //  $('#delete-ok').empty();
                //$('#delete-ok').append('<div>Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
                $(parent).fadeOut('slow');
              console.log(server);
            }
        });
        
      }    
    });  
  
  
  //AJAX INMUEBLES
  //BORRAR INMUEBLE
   $('.eliminar-inmueble').click(function(){
     
      if(confirm("Seguro que quieres borrar inmueble?")){        
        //Recogemos la id del contenedor padre
        var parent = $(this).parent().parent().parent();
        //Recogemos el valor del servicio
        var service = $(this).attr('data');  
        console.log(service);
        var dataString = 'id='+service;
        $.ajax({
            type: "POST",
            url: "eliminar.inmuebles.php",
            data: dataString,
            success: function(server) {            
              //  $('#delete-ok').empty();
                //$('#delete-ok').append('<div>Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
                $(parent).fadeOut('slow');
              console.log(server);
            }
        });
        
      }    
    });  
  
   //BORRAR IMAGEN INMUEBLES
   $('.eliminar_imagen_inmueble').click(function(){     
      if(confirm("Seguro que quieres borrar inmueble?")){        
        //Recogemos la id del contenedor padre
      var parent = $(this).parent();
        //Recogemos el valor del servicio
        var service = $(this).attr('data');  
        var service2 = $(this).attr('data2');  
                          
        var dataString = 'id='+service+'&nombre='+service2;
         
        $.ajax({
            type: "POST",

            url: "eliminar.imagen.inmuebles.php",
            data: dataString,
            success: function(server) {            
              //  $('#delete-ok').empty();
                //$('#delete-ok').append('<div>Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
              $(parent).fadeOut('slow');
              console.log(server);
            }
        });
        
      }    
    });  
  
    


  
  
  
  
  
})();