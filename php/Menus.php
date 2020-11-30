<div id='page-wrap'>
  <header class='main' id='h1'>
    <?php
    if (!isset($_SESSION['email'])) {
      echo '<span class="right"><a href="Register.php">Registro</a></span>
    <span class="right"><a href="LogIn.php">Login</a></span>
    <span class="right" style="display:none;"><a href="/logout.php">Logout</a></span>';
      echo ' Anonimo <img src="../uploads/anon.jpg" style="max-width:40px;width:100%;max-height:40px;height:100%"></img>';
    } else {
      include 'DbConfig.php';
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $foto = "../uploads/nophoto.jpg";
      if (isset($_SESSION['foto']))
        $foto = "../uploads/" . $_SESSION['foto'];
      $mail = $_SESSION['email'];
      echo $mail;
      echo ' <img src="';
      echo $foto;
      echo '" style="max-width:60px;width:100%;max-height:60px;height:100%"></img>';
      echo ' <a href="logout.php">Logout</a>';
    }
    ?>


  </header>
  <nav class='main' id='n1' role='navigation'>

    <?php
    include 'DbConfig.php';
    if (!isset($_SESSION['email'])) echo "<span><a href='Layout.php'>Inicio</a></span>
    <span><a href='Credits.php'>Creditos</a></span>";
    else {
      echo "<span><a href='Layout.php'>Inicio</a></span>";
      if ($_SESSION['tipo'] == 'W')
        echo "<span><a href='HandlingAccounts.php'>Gestionar Usuarios</a></span>";
      else
        echo "<span><a href='HandlingQuizesAjax.php'>Gestionar Preguntas</a></span>";
      if ($_SESSION['tipo'] == 'P')
        echo "<span><a href='ClientGetQuestion.php'>Get Question</a></span>";
      echo "<span><a href='Credits.php'>Creditos</a></span>";
    }

    ?>

  </nav>