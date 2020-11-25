<div id='page-wrap'>
  <header class='main' id='h1'>
    <?php
    if (!isset($_GET['email'])) {
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
      $query = $mysqli->prepare("SELECT foto FROM users WHERE email = ?");
      $query->bind_param("s", $_GET['email']);
      if ($query->execute()) {
        $result = $query->get_result();
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $foto = "../uploads/nophoto.jpg";
        if ($row['0'] != "-")
          $foto = "../uploads/" . $_GET['email'] . "." . $row['0'];
        $mail = $_GET['email'];
        echo $mail;
        echo ' <img src="';
        echo $foto;
        echo '" style="max-width:60px;width:100%;max-height:60px;height:100%"></img>';
        echo ' <a href="logout.php">Logout</a>';
      }
    }
    ?>


  </header>
  <nav class='main' id='n1' role='navigation'>

    <?php
    include 'DbConfig.php';
    if (!isset($_GET['email'])) echo "<span><a href='Layout.php'>Inicio</a></span>
    <span><a href='Credits.php'>Creditos</a></span>";
    else {
      $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
      if (!$mysqli) {
        echo ('MAL');
        die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
      }
      $email = mysqli_real_escape_string($mysqli, $_GET['email']);
      $query = $mysqli->query("SELECT * FROM users WHERE email ='" . $email . "' AND tipo='P'");
      if ($query->num_rows === 0)
        echo "    <span><a href='Layout.php?email=" . $mail . "'>Inicio</a></span>
    <span><a href=' HandlingQuizesAjax.php?email=" . $mail . "'>Gestionar Preguntas</a></span>
    <span><a href='Credits.php?email=" . $mail . "'>Creditos</a></span>";
      else
        echo "    <span><a href='Layout.php?email=" . $mail . "'>Inicio</a></span>
    <span><a href=' HandlingQuizesAjax.php?email=" . $mail . "'>Gestionar Preguntas</a></span>
    <span><a href='ClientGetQuestion.php?email=" . $mail . "'>Get Question</a></span>
    <span><a href='Credits.php?email=" . $mail . "'>Creditos</a></span>";
    }
    ?>

  </nav>