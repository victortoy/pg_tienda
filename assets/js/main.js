function enviarPeticion(objeto, metodo, datos){
    $.ajax({
        url: "../libs/frontController.php",        
        type: "POST",  
        dataType: "json",      
        data: {
            objeto: objeto,
            metodo: metodo,
            datos: datos
        },        
        success: function(respuesta){
            console.log(respuesta)
        }
    })
}

function parsearFormulario(formulario){
    let arreglo = formulario.serializeArray()
    let respuesta = {}
    for(let i = 0; i < arreglo.length; i++){
        respuesta[arreglo[i].name] = arreglo[i].value
    }
    return respuesta
}