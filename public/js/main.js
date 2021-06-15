// Función para ocultar menu sidebar
function ocultar_mostrar(){
    var span = document.getElementsByClassName("item");
    for(var i=0; i<span.length; i++){
        if(span[i].style.display!="block"){
            span[i].style.display = "block";
        }else{
            span[i].style.display ="none";
        }
    }
}

