<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formularios.css" />
    <title>Document</title>
</head>
<body>
    <?php
        include 'conexion.php';
    ?>

    <div class="form">
      <form action="agregarusuario.php" method="POST">
        <p>Nombre</p>
        <input type="text" class="input" placeholder="Nombre" name="nombre" required />

        <p>Apellido</p>
        <input type="text" class="input" placeholder="Apellido" name="apellido" required />

        <p>Rol</p>
        <select class="input" name="rol" id="rol" required onchange="mostrarCampos()">
          <option value="">-- Seleccionar --</option>
          <option value="admin">Admin</option>
          <option value="alumno">Alumno</option>
        </select>

        <div id="camposAlumno" style="display:none;">
          <p>Curso</p>
          <select class="input" name="curso" id="curso">
            <option value="">-- Seleccionar curso --</option>
            <option value="1">1A</option>
            <option value="2">1B</option>
            <option value="3">1C</option>
            <option value="4">2A</option>
            <option value="5">2B</option>
            <option value="6">2C</option>
            <option value="7">3A</option>
            <option value="8">3B</option>
            <option value="9">3C</option>
            <option value="10">4P</option>
            <option value="11">4E</option>
            <option value="12">4M</option>
            <option value="13">5P</option>
            <option value="14">5E</option>
            <option value="15">5M</option>
            <option value="16">6P</option>
            <option value="17">6E</option>
            <option value="18">6M</option>
            <option value="19">7P</option>
            <option value="20">7E</option>
            <option value="21">7M</option>
          </select>

          <p>Tribu</p>
          <select class="input" name="tribu" id="tribu">
            <option value="">-- Seleccionar tribu --</option>
            <option value="1">Violeta</option>
            <option value="2">Naranja</option>
            <option value="3">Verde</option>
            <option value="4">Azul</option>
          </select>
        </div>

        <p>Email</p>
        <input type="email" class="input" placeholder="Email" name="email" required />

        <p>Contraseña</p>
        <input type="text" class="input" placeholder="Contraseña" name="contraseña" required />

        <br /><br />
        <input type="submit" value="Aceptar" class="button" />
      </form>
    </div>

    <script>
        function mostrarCampos() {
            const rol = document.getElementById('rol').value;
            const camposAlumno = document.getElementById('camposAlumno');
            const curso = document.getElementById('curso');
            const tribu = document.getElementById('tribu');

            if (rol === 'alumno') {
                camposAlumno.style.display = 'block';
                curso.required = true;
                tribu.required = true;
            } else {
                camposAlumno.style.display = 'none';
                curso.required = false;
                tribu.required = false;
                curso.value = '';
                tribu.value = '';
            }
        }
    </script>
</body>
</html>