<!DOCTYPE html>
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
        <div>    
            <form id='register' name='fregister' action='AddQuestion.php' >
                <table style="margin: 0px auto">
                    <tr>
                        <td align="left"><label id="luser">Usuario*: </label></td>
                        <td><input type="text" id="user" name="user"></td>
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
                        <td><input type="text" id="password" name="password"></td>
                    </tr>
                    <tr>
                        <td align="left"><label id="lpassword2">Repetir Contraseña*: </label></td>
                        <td><input type="text" id="password2" name="password2"></td>
                    </tr>
                </table>
            </form>
        </div>    
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>