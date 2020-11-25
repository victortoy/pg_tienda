<?php require('header.php');?>

<div class="container mt-3">
    <div class="row">
        <div class="col-4 col-md-3 col-lg-2"><h1>Empresas</h1></div>
        <div class="col-8 col-md-9 col-lg-10">
            <button type="button" class="btn btn-primary" id="nuevoEmpresas"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="row" id="contenido"></div>
</div>

<div class="modal" tabindex="-1" id="modalEmpresas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioEmpresas">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required="required">
                    </div>                        
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="formularioEmpresas">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php');?>

    <script>
        var accion = 'guardar'
        var id = 0
        function init(){
            $('#nuevoEmpresas').on('click', function(){
                accion = 'guardar'
                $('#modalEmpresas').modal('show')
            })

            //Cargar datos existentes
            cargarRegistros({1:1}, 'crear')

            enviarPeticion('empresas', 'prueba', {1:1}, function(resp){
            	console.log(resp)
            })

            $('#formularioEmpresas').on('submit', function(event){
                event.preventDefault();
                let datos = parsearFormulario($(this))
                if(accion == 'guardar'){
                    enviarPeticion('empresas', 'insert', datos, function(resp){
                        cargarRegistros({id:resp.ultimo_insertado}, 'crear')
                        $('#modalEmpresas').modal('hide')
                    })
                }else{
                    datos.id = id
                    enviarPeticion('empresas', 'update', datos, function(resp){
                        cargarRegistros({id: id}, 'actualizar')
                        $('#modalEmpresas').modal('hide')
                    })
                }
            })
        }

        function cargarRegistros(datos, accion){
            let fila = ''
            enviarPeticion('empresas', 'select', datos, function(resp){
                for(let i = 0; i < resp.registros.length; i++){
                	fila += `<div class="col-4" id=${resp.registros[i].id}>
	        					<div class="card">
	  								<div class="card-header">	  									
	    								${resp.registros[i].nombre}
	    								<div class="float-right">
	    									<button class="btn btn-link" onClick="editar(${resp.registros[i].id})"><i class="fas fa-edit"></i></button>		
	    								</div>
	  								</div>
	  								<div class="card-body">
	    								<h5 class="card-title">Special title treatment</h5>
	    								<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
	    								<a href="#" class="btn btn-primary">Go somewhere</a>
	  								</div>
								</div>
							</div>`
                }
                if(accion == 'crear'){
                    $('#contenido').append(fila)
                }else{
                    $('#'+id).replaceWith(fila)
                }
            })
        }

        function editar(codigo){
            accion = 'actualizar'
            id = codigo
            $('#modalEmpresas').modal('show')
            enviarPeticion('empresas', 'select', {id: codigo}, function(resp){
                $('input[name=nombre]').val(resp.registros[0].nombre)
            })
        }

        function borrar(codigo){
            if (confirm('Esta seguro de borrar?')) {
                enviarPeticion('empresas', 'delete', {id: codigo}, function(resp){
                    $('#'+codigo).hide('slow')
                })
            }            
        }
    </script>
  </body>
</html>