<!DOCTYPE html>
<html>

<head>
    <?php include '../html/Head.html' ?>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/mostrarUser.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>

    <div>
        <label id='linco3'>Elija el usuario: </label>
        <select id="usuarios" name="usuarios" onchange='valor(this.value)'>
            <?php
            include 'DbConfig.php';
            $mysqli = mysqli_connect($server, $user, $pass, $basededatos);
            if (!$mysqli) {
                echo ('MAL');
                die('Fallo al conectar a MySQL: ' . mysqli_connect_error());
            }
            $user = mysqli_query($mysqli, "select * from users");
            while ($row = mysqli_fetch_array($user)) {
                echo '<option> ' . htmlspecialchars($row['email']) . '</option>';
            }
            ?>
        </select>
        <label id='mailAux'></label>
        <label id='passAux'></label>
        <label id='fotoAux'></label>
    </div>

    <?php include '../html/Footer.html' ?>
</body>

</html>