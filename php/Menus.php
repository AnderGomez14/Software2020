<div id='page-wrap'>
  <header class='main' id='h1'>
    <?php
    if (!isset($_GET['email'])) {
      echo '<span class="right"><a href="register.php">Registro</a></span>
    <span class="right"><a href="LogIn.php">Login</a></span>
    <span class="right" style="display:none;"><a href="/logout">Logout</a></span>';
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
    if (isset($_GET['email']))
      echo "    <span><a href='Layout.php?email=" . $mail . "'>Inicio</a></span>
    <span><a href='QuestionFormWithImage.php?email=" . $mail . "'> Insertar Pregunta</a></span>
    <span><a href=' ShowQuestionsWithImage.php?email=" . $mail . "'> Ver Preguntas</a></span>
    <span><a href='Credits.php?email=" . $mail . "'>Creditos</a></span>";
    else echo "    <span><a href='Layout.php'>Inicio</a></span>
    <span><a href='Credits.php'>Creditos</a></span>"
    ?>

  </nav>