<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html' ?>
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/ValidateFieldsQuestion.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div>
			<form id='fquestion' name='fquestion' action='AddQuestion.php'>
				<label id="lmail">Email*: </label>
				<input type="email" id="mail" name="mail" pattern="([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+[0-9]{3}(@ikasle.ehu.)((eus)|(es)))|([a-zA-Z]+(@ehu.)((eus)|(es)))" required><br>
				<label id='lenunciado'>Enunciado de la pregunta:* </label>
				<input type="text" id="enunciado" name="enunciado" minlength="10" required><br>
				<label id='lcorrecta'>Respuesta correcta*: </label>
				<input type="text" id="correcta" name="correcta" required><br>
				<label id='linco1'>Respuesta incorrecta 1*: </label>
				<input type="text" id="inco1" name="inco1" required><br>
				<label id='linco2'>Respuesta incorrecta 2*: </label>
				<input type="text" id="inco2" name="inco2" required><br>
				<label id='linco3'>Respuesta incorrecta 3*: </label>
				<input type="text" id="inco3" name="inco3" required><br>
				<label id='lcomplejidad'>Complejidad*: </label>
				<select id="complejidad" name="complejidad" required>
					<option value="1">Baja</option>
					<option value="2">Media</option>
					<option value="3">Alta</option>
				</select> <br>
				<label id='ltema'>Tema*: </label>
				<input type="text" id="tema" name="tema" required><br><br>
				<input type="submit" value="Enviar pregunta">
			</form>

			<label id="resul"></label>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>