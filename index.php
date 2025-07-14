<?php
session_start();

$error = isset($_GET['error']) ? $_GET['error'] : null;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Acceso Seguro | Tu Empresa</title>
  <link rel="stylesheet" href="CSS/style-h.css?v=1.0">
</head>

<body>
  <div class="login-wrapper">
    <div class="login-card" id="card">
      <div class="logo-container">
        <img src="IMG/logo.png" alt="Logo de la empresa" class="logo" />
      </div>

      <div class="login-content">
        <h1 class="login-title">Inicio de Sesión</h1>

        <form id="loginForm" method="POST" action="Controller/validar.php">
          <div class="input-group">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" placeholder="Ingrese su usuario" required />
          </div>

          <div class="input-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required />
          </div>

          <div class="show-password">
            <input type="checkbox" id="togglePassword" />
            <label for="togglePassword">Mostrar contraseña</label>
          </div>

          <button type="submit" class="login-btn" id="loginBtn">Ingresar</button>
          <?php if ($error == 1) :
            echo '<p class="error-message" id="errorMsg">Credenciales incorrectas. Intente de nuevo.</p>';
          endif;
          ?>
        </form>
      </div>
    </div>
    <p class="footer-text">&copy; 2025 Freshco. Todos los derechos reservados.</p>
  </div>
</body>
 <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
      
    togglePassword.addEventListener('change', function () {
      passwordInput.type = this.checked ? 'text' : 'password';
    });
  </script>

</html>