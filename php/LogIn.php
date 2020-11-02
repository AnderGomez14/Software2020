<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ValidateFieldsQuestion.js"></script>
</head>

<body>
    <?php include '../php/Menus2.php' ?>
    <section class="main" id="s1">
        <form id='login' name='flogin' method="POST" action='LogIn.php'>
            <div>
                <table style="margin: 0px auto">
                    <tr>
                        <td align="left"><label id="luser">Email*: </label></td>
                        <td><input type="text" id="user" name="user"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword">Contraseña*: </label></td>
                        <td><input type="text" id="password" name="password"></td>
                    </tr>
                </table>

            </div>
            <input type="submit" value="Iniciar Sesion"><br><br>

        </form>
        <?php
        include 'DbConfig.php';
        if (isset($_POST['user'])) {
            if (empty($_POST['user']) || empty($_POST['password'])) {
                echo 'Rellena todos los campos';
            } else {
                $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
                if (!$mysqli) {
                    echo ('MAL');
                    die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
                }
                $query = $mysqli->prepare("SELECT * FROM users WHERE password = ?");
                $query->bind_param("s", $_POST['password']);
                if ($query->execute()) {
                    $count = $query->num_rows;
                    printf("Result set has %d rows.\n", $count);
                    if ($query->num_rows == 0)
                        echo 'nice try';
                    else
                        echo 'Logeo correcto';
                }
            }
        }
        ?>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>