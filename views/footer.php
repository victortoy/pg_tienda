<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="../assets/js/main.js"></script>
<script>
	$(function(){
        enviarPeticion('usuarios', 'getSesion', {1:1}, function(resp){
            if(resp.registros.length == 0){
                $('#navbarCollapse').append(`<ul class="navbar-nav mr-auto">                    
                							</ul>
                							<a class="btn btn-link my-2 my-sm-0" href="login.php">Entrar</a>
                							<a class="btn link my-2 my-sm-0" href="registrarse.php">Registrarse</a>`)
            }else{
            	$('#navbarCollapse').append(`<ul class="navbar-nav mr-auto">
            									<li class="nav-item">
                        							<a class="nav-link" href="usuarios.php">Usuarios<span class="sr-only">(current)</span></a>
                    							</li>
                    							<li class="nav-item">
                        							<a class="nav-link" href="empresas.php">Empresas<span class="sr-only">(current)</span></a>
                    							</li>                    							
                							</ul>
                							<span class="nav-item dropdown pr-5">
    											<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      												${resp.registros.nombre}
    											</a>
    											<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      												<a class="dropdown-item" href="#" id="salir">Salir</a>
    											</div>
  											</span>`)
            	$('#salir').on('click', function(){
            		enviarPeticion('usuarios', 'destroySesion', {1:1}, function(resp){
                		window.location.href = 'index.php'
            		})  
        		})
        		init()                        
            }            
        })            

        
    })
</script>