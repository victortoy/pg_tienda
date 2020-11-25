<?php require('header.php');?>

<div class="container mt-3">
    <div class="row">
        <div class="col-4 col-md-3 col-lg-2"><h1>Usuarios</h1></div>
        <div class="col-8 col-md-9 col-lg-10">
            <button type="button" class="btn btn-primary" id="nuevoUsuarios"><i class="fas fa-plus"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="contenido"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="modalUsuarios">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioUsuarios">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" class="form-control" name="correo" required="required">
                    </div>
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="number" class="form-control" name="telefono" required="required">
                    </div>                        
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" form="formularioUsuarios">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php');?>

    <script>
        var accion = 'guardar'
        var id = 0        
        function init(){
            $('#nuevoUsuarios').on('click', function(){
                accion = 'guardar'
                $('#modalUsuarios').modal('show')
            })

            //Cargar datos existentes
            cargarRegistros({1:1}, 'crear')

            $('#formularioUsuarios').on('submit', function(event){
                event.preventDefault();
                let datos = parsearFormulario($(this))
                if(accion == 'guardar'){
                    enviarPeticion('usuarios', 'insert', datos, function(resp){
                        cargarRegistros({id:resp.ultimo_insertado}, 'crear')
                        $('#modalUsuarios').modal('hide')
                    })
                }else{
                    datos.id = id
                    enviarPeticion('usuarios', 'update', datos, function(resp){
                        cargarRegistros({id: id}, 'actualizar')
                        $('#modalUsuarios').modal('hide')
                    })
                }
            })
        }

        function cargarRegistros(datos, accion){
            let fila = ''
            enviarPeticion('usuarios', 'select', datos, function(resp){
                for(let i = 0; i < resp.registros.length; i++){
                    fila += `<tr id=${resp.registros[i].id}>
                                <td>${resp.registros[i].id}</td>
                                <td>${resp.registros[i].nombre}</td>
                                <td>${resp.registros[i].correo}</td>
                                <td>${resp.registros[i].telefono}</td>
                                <td><button class="btn btn-secondary" onClick="editar(${resp.registros[i].id})"><i class="fas fa-edit"></i></button> <button class="btn btn-danger" onClick="borrar(${resp.registros[i].id})"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>`
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
            $('#modalUsuarios').modal('show')
            enviarPeticion('usuarios', 'select', {id: codigo}, function(resp){
                $('input[name=nombre]').val(resp.registros[0].nombre)
                $('input[name=correo]').val(resp.registros[0].correo)
                $('input[name=telefono]').val(resp.registros[0].telefono)
            })
        }

        function borrar(codigo){
            if (confirm('Esta seguro de borrar?')) {
                enviarPeticion('usuarios', 'delete', {id: codigo}, function(resp){
                    $('#'+codigo).hide('slow')
                })
            }            
        }
    </script>
  </body>
</html>