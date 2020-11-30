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
    <script src="../js/ShowImageInForm.js"></script>
    <script src="../js/ShowQuestionAjax.js"></script>
    <script src="../js/AddQuestionAjax.js"></script>
    <script src="../js/LiveAjax.js"></script>
</head>

<body>
    <?php include '../php/Menus.php' ?>
    <section class="main" id="s1">
        <?php if (!isset($_SESSION['email']) || $_SESSION['tipo'] == 'W') die('Pagina restringida solo para usuarios');  ?>
        <div id="liveCount">Usarios actualmente editando la base de datos: <div id="nUsers">
            </div>
        </div>
        <div id="liveQuestions">Preguntas actualmente en la DB: <div id="nQuestions">
            </div>
        </div>
        <div id="formDiv">
            <form id='fquestion'>
                <table id="tform" style="margin: 0px auto">
                    <tr hidden>
                        <td align="left"><label id="lmail">Email*: </label></td>
                        <td><input type="text" id="mail" name="mail" value="<?php echo $_SESSION['email']; ?>"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='lenunciado'>Enunciado de la pregunta:* </label></td>
                        <td><input type="text" id="enum" name="enum"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='lcorrecta'>Respuesta correcta*: </label></td>
                        <td><input type="text" id="correcta" name="correcta"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='linco1'>Respuesta incorrecta 1*: </label></td>
                        <td><input type="text" id="inco1" name="inco1"><br></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='linco2'>Respuesta incorrecta 2*: </label></td>
                        <td><input type="text" id="inco2" name="inco2"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='linco3'>Respuesta incorrecta 3*: </label></td>
                        <td><input type="text" id="inco3" name="inco3"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='lcomplejidad'>Complejidad*: </label></td>
                        <td> <select id="complejidad" name="complejidad">
                                <option value="1">Baja</option>
                                <option value="2">Media</option>
                                <option value="3">Alta</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td align="left"><label id='ltema'>Tema*: </label></td>
                        <td><input type="text" id="tema" name="tema"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lfile">Avatar: </label></td>
                        <td><input type="file" id="archivosubido" name="archivosubido" accept="image/*" onchange="preview()"></td>
                    </tr>
                </table>
                <br>
                <input type="reset" value="Reset form">
            </form>
        </div>
        <input type="button" value="Enviar pregunta" onclick="insertarPreguntas()">
        <input type="button" value="Ver Preguntas" onclick="verPreguntas()">
        <div id="introducirBD">
            <label id="mensaje"></label>
        </div><br>
        <div id="verPreguntas"></div>
    </section>
    <?php include '../html/Footer.html' ?>
    <script>
        liveCounters();
    </script>
</body>

</html>