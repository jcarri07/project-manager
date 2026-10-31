<?php
// Mantener la lógica del inicio de sesión en login_check.php.
// Este archivo únicamente muestra el formulario.
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>SIGPR - Sistema de Información para la Gestión de Proyectos</title>

  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">

  <link rel="stylesheet" href="assets/css/material-menu.css">

  <style>
    .index_admin i label[for="ShowPassword"] {
      display: inline;
    }

    /* Pie del formulario */
    .index_admin .footer-logo-area {
      margin-top: 22px;
      padding-top: 16px;
      border-top: 1px solid #e8eef5;
      color: #6c757d;
      font-size: 0.75rem;
      letter-spacing: 0.3px;
    }
  </style>
</head>

<body>

  <!-- Fondo principal -->
  <main class="gallery-container">


    <form class="index_admin" name="Menu" action="login_check.php" method="POST" autocomplete="on">

      <h2>

        <div class="texto-adi">SIGPR</div>

        <div class="texto-encima">
          Sistema de Información para la Gestión de Proyectos
        </div>

      </h2>

      <!-- Mensaje de error -->
      <?php if (isset($_GET['alert']) && $_GET['alert'] == '1'){ ?>

        <div class="error" role="alert">
          Error al iniciar sesión.
          Los datos ingresados son inválidos o incorrectos.
        </div>

      <?php } ?>

      <!-- Cédula -->
      <div class="form-group">

        <label for="cedula">Cédula de identidad</label>

        <input
          class="control"
          type="text"
          name="cedula"
          id="cedula"
          placeholder="Cédula de Identidad"
          autocomplete="username"
          required>

      </div>

      <!-- Contraseña -->
      <div class="form-group">

        <label for="Contraseña">Contraseña</label>

        <input
          class="control"
          type="password"
          name="password"
          id="Contraseña"
          placeholder="Contraseña"
          autocomplete="current-password"
          required>

      </div>

      <!-- Visualizar contraseña -->
      <i>
        <input
          class="form-check-input"
          type="checkbox"
          id="ShowPassword">

        <label
          class="form-check-label"
          for="ShowPassword">

          Visualizar contraseña

        </label>
      </i>

      <!-- Botón de acceso -->
      <div>

        <input
          class="botton"
          type="submit"
          name="login"
          id="Bot"
          value="Iniciar Sesión">

      </div>

      <!-- Pie del formulario -->
      <div class="footer-logo-area">
        Sistema de Gestión de Proyectos
      </div>

    </form>

  </main>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const checkbox = document.getElementById('ShowPassword');
      const password = document.getElementById('Contraseña');

      checkbox.addEventListener('change', function() {

        password.type = this.checked ? 'text' : 'password';

      });

    });
  </script>

</body>

</html>