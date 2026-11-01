<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>SIGPR - Sistema de Información para la Gestión de Proyectos</title>

  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">

  <link rel="stylesheet" href="assets/css/material-menu.css">

</head>

<body>

  <style>

    .index_admin .login-header {
    display: grid;
    grid-template-columns: 65px minmax(0, 1fr) 65px;
    align-items: center;
    gap: 12px;
    width: 100%;
    min-height: 90px;
    padding: 5px 0 20px;
    margin-bottom: 28px;
    border-bottom: 2px solid var(--menu-primary-subtle);
    position: relative;
}

    .login-logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 75px;
}

.login-logo {
    display: block;
    object-fit: contain;
    max-width: 100%;
    max-height: 100%;
    transition: transform var(--menu-transition),
        opacity var(--menu-transition);
}

.login-logo-left {
    width: 75px;
    height: 65px;
}

.login-logo-right {
    width: 58px;
    height: 58px;
}

.login-logo:hover {
    transform: scale(1.06);
    opacity: 0.85;
}

.login-header-text {

    min-width: 0;

    width: 100%;

    text-align: center;

}

  </style>

  <main class="gallery-container">


    <form class="index_admin" name="Menu" action="login_check.php" method="POST" autocomplete="on">

      <div class="login-header">

        <!-- Logo institucional izquierdo -->
        <div class="login-logo-container logo-left">
            <img
                src="assets/img/ABAE_logo.png"
                alt="Logo institucional"
                class="login-logo login-logo-left">
        </div>

        <!-- Texto central -->
        <div class="login-header-text">
            <div class="texto-adi">SIGPR</div>

            <div class="texto-encima">
                Sistema de Información para la Gestión de Proyectos
            </div>
        </div>

        <!-- Logo institucional derecho -->
        <div class="login-logo-container logo-right">
            <img
                src="assets/img/apple-icon.png"
                alt="Logo SIGPR"
                class="login-logo login-logo-right">
        </div>

      </div>

      <?php if (isset($_GET['alert']) && $_GET['alert'] == '1'){ ?>

        <div class="error" role="alert">
          Error al iniciar sesión.
          Los datos ingresados son incorrectos.
        </div>

      <?php } ?>

      <div class="form-group">

        <label for="cedula">Cédula de identidad</label>

        <input class="control" type="text" name="cedula" id="cedula" placeholder="Cédula de Identidad" autocomplete="username" required>

      </div>

      <div class="form-group">

        <label for="Contraseña">Contraseña</label>

        <input class="control" type="password" name="password" id="Contraseña" placeholder="Contraseña" autocomplete="current-password" required>

      </div>

      <i>
        <input class="form-check-input" type="checkbox" id="ShowPassword">

        <label class="form-check-label" for="ShowPassword">
          Visualizar contraseña
        </label>
      </i>
      <div>

        <input class="botton" type="submit" name="login" id="Bot"  value="Iniciar Sesión">

      </div>

      <div class="footer-logo-area">
        Sistema de Gestión de Proyectos
      </div>

    </form>

  </main>

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