<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="formularios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <title>Inicio Sesion</title>
  </head>

  <body class="hero">
    <div class="form">
      <form action="verificacionlogin.php" method="POST">
       
        <p>Email</p>
        <input
          type="email"
          class="input"
          placeholder="Email"
          name="email"
          required
        />
        <p>Contraseña</p>
        <input
          type="text"
          class="input"
          placeholder="Contraseña"
          name="contraseña"
          required
        />
        <br /><br />
        <input type="submit" value="Iniciar sesion" class="button" />
        
      </form>
    </div>
  </body>
</html>