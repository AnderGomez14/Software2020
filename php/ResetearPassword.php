<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
    <script src="../js/ContrasenaValid.js"></script>
    <script>
        function poderRegistrarse() {
            if ($('#PASS').text() == 'Contraseña Valida') {
                $('#Registrarse').prop('disabled', false);
            } else {
                $('#Registrarse').prop('disabled', true);
            }
        }
        setInterval(poderRegistrarse, 1000);
    </script>

</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <?php if (isset($_SESSION['email']))
            die('Ya estas logeado');
        if (!isset($_GET['key'])) {
            die('Faltan parametros');
        }
        $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
        if (!$mysqli) {
            echo ('MAL');
            die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
        }
        $codigo = mysqli_real_escape_string($mysqli, $_GET['key']);
        $query = $mysqli->query("SELECT email FROM users WHERE reset='" . $codigo . "'");
        if ($query->num_rows === 0)
            die('Codigo invalido');
        else
            $email = mysqli_fetch_array($query)['email'];
        ?>
        <form id='login' name='flogin' method="POST" action='ResetearPassword.php?key=<?php echo $_GET['key']; ?>'>
            <div>
                <table id="tform" style="margin: 0px auto">
                    <tr>
                    <tr>
                        <td align="left"><label id="lpassword">Nueva contraseña*: </label></td>
                        <td><input type="password" id="password" name="password" onblur="passValid(this.value)"></td>
                        <td><label id="PASS" name="PASS"></label>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword2">Repetir la nueva contraseña*: </label></td>
                        <td><input type="password" id="password2" name="password2"></td>
                    </tr>
                    </tr>
                </table>
            </div>
            <input type="submit" id='Registrarse' value="Recuperar contraseña" disabled><br><br>
        </form>
        <?php
        include 'DbConfig.php';
        if (isset($_POST['password']) && isset($_POST['password2'])) {
            if (empty($_POST['password']) && empty($_POST['password2'])) {
                echo 'Rellena todos los campos';
            } else if ($_POST['password'] != $_POST['password2']) {
                echo 'Las contraseñas no coinciden';
            } else {
                $salt = $email . "#Vadillo007STONKS";
                $contraseñasegura = crypt($_POST['password'], $salt);
                $query = mysqli_query($mysqli, "UPDATE users SET password = '" . $contraseñasegura . "', reset = NULL WHERE email = '" . $email . "'");
                mysqli_close($mysqli);
                echo '<script>alert("Contraseña cambiada con exito");window.location.href = "' . $url . '/MikelGarcia-AnderGomez/php/LogIn.php";</script>';
            }
        }
        ?>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>