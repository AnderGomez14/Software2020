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
    <script src="../js/mostrarUser.js"></script>
    <script src="../js/botonesEstado.js"> </script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <?php if (!isset($_SESSION['email']) || $_SESSION['tipo'] != 'W') die('Pagina restringida solo para usuarios');  ?>
        <div>
            <label id='linco3'>Elija el usuario: </label>
            <select id="usuarios" name="usuarios" onchange='valor(this.value)'>
                <option value="" disabled selected>Elige El email del usuario</option>
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
            <br>
            <br>
            <br>
            <div id="userInfo" hidden>
                <table id='tshow' style="margin: 0px auto">
                    <tr align="left">
                        <td><label>Email: </label></td>
                        <td><label id='mailAux' style="color:green"></label></td>
                    </tr>
                    <tr align="left">
                        <td><label>Contraseña: </label></td>
                        <td><label id='passAux' style="color:green"></label></td>
                    </tr>
                    <tr align="left">
                        <td><label>Foto: </label></td>
                        <td><img id='fotoAux' style='max-width:60px;width:100%;max-height:60px;height:100%'></img> </td>
                    </tr>
                </table> <br>
                <br>
                <table style="margin: 0px auto">
                    <tr align="left">
                        <td><button id=Actividad onclick="esValido()">Estado Cuenta</button></td>
                        <td><button id=CambiarEstado onclick="cambiarEstado()">Activar/Desactivar</button></td>
                        <td><button id=eliminar onclick="eliminarUser()">Eliminar Usuario</button></td>
                    </tr>
                    <tr align="left">
                        <td><label id='estado'></label></td>
                    </tr>
                </table>
            </div>

        </div>
    </section>
    <?php include '../html/Footer.html' ?>
</body>

</html>