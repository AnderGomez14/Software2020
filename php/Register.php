<?php if (!isset($_SESSION))
    session_start(); ?>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/ClienteVIP.js"></script>
    <script src="../js/ContrasenaValid.js"></script>
    <script>
        function poderRegistrarse() {
            if (($('#VIP').text() == 'El usuario es VIP') && ($('#PASS').text() == 'Contraseña Valida')) {
                $('#Registrarse').prop('disabled', false);
            }
        }
        setInterval(poderRegistrarse, 1000);
    </script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <div id="formDiv">
            <?php if (isset($_SESSION['email']))
                die('Ya estas logeado'); ?>
            <form id='register' name='fregister' enctype="multipart/form-data" action='Register.php' method="POST">
                <table id="tform" style="margin: auto">
                    <tr>
                        <td align="left"><label id="ltipo">Tipo de Usuario*: </label></td>
                        <td>Alumno <input type="radio" id="tipo" name="tipo" value="A" checked>
                            Profesor <input type="radio" id="tipo" name="tipo" value="P"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lemail">Email*: </label></td>
                        <td><input type="text" id="email" name="email" onblur="esVIP(this.value)"></td>
                        <td><label id="VIP" name="VIP"></label>
                    </tr>
                    <tr>
                        <td align="left"><label id="lname">Nombre y Apellidos*: </label></td>
                        <td><input type="text" id="name" name="name"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword">Contraseña*: </label></td>
                        <td><input type="password" id="password" name="password" onblur="passValid(this.value)"></td>
                        <td><label id="PASS" name="PASS"></label>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword2">Repetir Contraseña*: </label></td>
                        <td><input type="password" id="password2" name="password2"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lfile">Avatar: </label></td>
                        <td><input type="file" id="archivosubido" name="archivosubido" accept="image/*" onchange="preview()"></td>
                    </tr>
                    <tr>
                        <td align="left">
                            <label>* Campo obligatorio </label>
                        </td>

                    </tr>
                </table>
                <br>
                <input type="reset" value="Limpiar">
                <input type="submit" id='Registrarse' name='Registrarse' value="Registrarse" disabled='true'><br><br>
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
                } else if (!((preg_match("/([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))/", $_POST['email']) && $_POST['tipo'] == 'A') || (preg_match("/([a-zA-Z]+(@ehu.)((eus)|(es)))/", $_POST['email']) && $_POST['tipo'] == 'P')) && $_POST['email'] != 'admin@ehu.es') {
                    echo ('Error: Email incorrecto para el tipo de usuario indicado');
                } else {
                    $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                    if (!$mysqli) {
                        die('Fallo al conectar a MySQL');
                    }
                    $extension = "-";
                    if (!$_FILES["archivosubido"]["error"] != 0) {
                        $extension = strtolower(pathinfo(basename($_FILES["archivosubido"]["name"]), PATHINFO_EXTENSION));
                    }

                    #Encriptamos las contraseñas y usamos como salt el email y una constante (#Vadillo007STONKS)
                    #Por ejemplo, si mi email es vadillo@ehu.eus y mi contraseña es 123456,
                    #la contraseña 123456 se hashearia con la salt "vadillo@ehu.eus#Vadillo007STONKS"
                    #Esto lo hago porque obviamente es ilegal guardar contraseñas en plano por la ley de proteccion de datos
                    $salt = $_POST['email'] . "#Vadillo007STONKS";
                    $contraseñasegura = crypt($_POST['password'], $salt);
                    $tipo = $_POST['tipo'];
                    if ($_POST['email'] == 'admin@ehu.es')
                        $tipo = 'W'; //W de Webmaster
                    $query = $mysqli->prepare("INSERT INTO users(tipo,email,nombre,password,foto) VALUES (?,?,?,?,?)");
                    $query->bind_param("sssss", $tipo, $_POST['email'], $_POST['name'], $contraseñasegura, $extension);
                    if (!$query->execute())
                        die('Error: No se ha podido añadir a la base de datos' . mysqli_error($mysqli));
                    if (!$_FILES["archivosubido"]["error"] != 0) {
                        if (!subir($_FILES, $target_dir, $_POST['email'])) {
                            $email = $_POST['email'];
                            mysqli_query($mysqli, "DELETE FROM users WHERE email = '$email'");
                            die();
                        }
                    }
                    echo '<script>alert("Usuario creado satisfactoriamente.");window.location.href = "LogIn.php";</script>';
                }
            }
            ?>
            <br><br>
        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>