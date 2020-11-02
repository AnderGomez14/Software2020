<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
</head>

<body>
    <?php include '../php/Menus2.php' ?>
    <section class="main" id="s1">
        <div id="formDiv">
            <form id='register' name='fregister' enctype="multipart/form-data" action='Register.php' method="POST">
                <table style="margin: 0px auto">
                    <tr>
                        <td align="left"><label id="ltipo">Tipo de Usuario*: </label></td>
                        <td>Alumno <input type="radio" id="tipo" name="tipo" value="A" checked></td>
                        <td>Profesor <input type="radio" id="tipo" name="tipo" value="P"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lemail">Email*: </label></td>
                        <td><input type="text" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lname">Nombre y Apellidos*: </label></td>
                        <td><input type="text" id="name" name="name"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword">Contraseña*: </label></td>
                        <td><input type="password" id="password" name="password"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword2">Repetir Contraseña*: </label></td>
                        <td><input type="password" id="password2" name="password2"></td>
                    </tr>
                </table>
                <input type="file" id="archivosubido" name="archivosubido" accept="image/*" onchange="preview()"><br>
                <br>
                <input type="submit" value="Enviar pregunta"><br><br>
            </form>
            <?php
            include 'DbConfig.php';
            include 'SubirImagen.php';

            //error_reporting(E_ALL ^ E_NOTICE);
            if (isset($_POST['email'])) {

                if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['password2']) || empty($_POST['tipo'])) {
                    echo ('Error: Faltan parametros');
                } else if (!(preg_match("/[A-Za-z]+[ ][A-Za-z]+/", $_POST["name"]))) {
                    echo ('Error: Nombre Incorrecto. ha de contener un nombre y un apellido');
                } else if (strlen($_POST['password']) < 6) {
                    echo ('Error: La contraseña ha de ser de minimo 6 caracteres');
                } else if ($_POST['password'] != $_POST['password2']) {
                    echo ('Error: Las contraseñas no coinciden');
                } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    echo ('Error: Email incorrecto');
                } else {
                    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                    if (!$mysqli) {
                        echo '<br> <img src="https://pbs.twimg.com/media/ETXT7KYXgAATG5I.jpg" style="max-width:300px;width:100%"></img> <br>';
                        die('Fallo al conectar a MySQL');
                    }
                    $extension = "-";
                    if (!$_FILES["archivosubido"]["error"] != 0) {
                        $extension = strtolower(pathinfo(basename($_FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
                    }
                    $query = $mysqli->prepare("INSERT INTO users(tipo,email,nombre,password,foto) VALUES (?,?,?,?,?)");
                    $query->bind_param("sssss", $_POST['tipo'], $_POST['email'], $_POST['name'], $_POST['password'], $extension);
                    if (!$query->execute())
                        die('Error: No se ha podido añadir a la base de datos' . mysqli_error($mysqli));
                    if (!subir($_FILES, $target_dir, $_POST['email'])) {
                        $email = $_POST['email'];
                        mysqli_query($mysqli, "DELETE FROM users WHERE email = '$email'");
                        die();
                    }
                    echo 'todo correcto';
                }
            }
            ?>
            <br>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>