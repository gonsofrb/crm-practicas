
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_URL ?>/css/estilos_login.css">
    <script src="https://kit.fontawesome.com/5c32f8297e.js" crossorigin="anonymous"></script>
    <title>ACCESO RESTRINGIDO</title>
</head>

<body>  
      <div class="login">
        <?php 
        if(isset($_SESSION['error_session'])){
          
            foreach($_SESSION['error_session'] as $error) : ?>
           <?php   echo "<p>".$error."</p>"; ?>
           <?php  endforeach;  
            
        }
        
        ?>
        <h2 class="login-header">ACCESO RESTRINGIDO</h2>
        <?php print_r($_SESSION); ?>

        <form class="login-contenedor" action="<?php echo PATH_URL ?>/Login/start/" method="POST">
          <p><label for="user_log"><i class="fas fa-user-secret"></i>&nbsp;Usuario</label></p>
          <p><input type="text" name="user_log" ></p>
          <p><label for="password_log"><i class="fas fa-key">&nbsp;Contraseña</i></label></p>
          <p><input type="password" name="password_log" ></p>
          <!-- <p><input type="hidden" name="input_falso" id="input_falso" value="73343"></p> -->
          <p><input type="submit" name="enviar" value="Acceder" ></input></p>
          <p class="recuperar"><a href="#">¿Has olvidado la contrase&ntilde;a?</a></p>
         
        </form>
       
      </div>
 
     

        
</body>

</html>

  