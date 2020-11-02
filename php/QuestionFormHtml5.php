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
				<table style="margin: 0px auto">
					<tr>
						<td align="left"><label id="lmail">Email*: </label></td>
						<td><input type="text" id="mail" name="mail"></td>
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
				</table><br><br>
				<input type="submit" value="Enviar pregunta">
			</form>
			<label id="resul"></label>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>