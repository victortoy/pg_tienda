<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center pt-5">
			<div class="col-4 col-offset-4">
				<div class="card">
  					<div class="card-header text-center">
    					Acceso
  					</div>
  					<div class="card-body">
						<form id="formulario">
							<div class="form-group">
		                        <label for="">Correo</label>
		                        <input type="email" class="form-control" name="correo" required="required">
		                    </div>
		                    <div class="form-group">
		                        <label for="">Contraseña</label>
		                        <input type="password" class="form-control" name="password" required="required">
		                    </div>
						</form>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary btn-block" form="formulario">Entrar</button>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <script>
    	$(function(){
    		$('#formulario').on('submit', function(event){
    			event.preventDefault();
    			let datos = parsearFormulario($(this))
    			enviarPeticion('usuarios', 'login', datos, function(resp){
    				window.location.href = 'index.php'
    			})
    		})
    	})
    </script>
</body>
</html>