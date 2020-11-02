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
        <form id='login' name='flogin' action='AddQuestion.php' >
            <div>
                <table style="margin: 0px auto">
                    <tr>
                        <td align="left"><label id="luser">Usuario*: </label></td>
                        <td><input type="text" id="user" name="user"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword">Contraseña*: </label></td>
                        <td><input type="text" id="password" name="password"></td>
                    </tr>
                </table>
            </div>
        </form>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>