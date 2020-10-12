<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
  <script src="../js/jquery-3.4.1.min.js"></script>
  <script src="../js/ValidateFieldsQuestion.js"></script>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
		<form id='fquestion' name='fquestion' action='AddQuestion.php'>
			<label>Email*: </label>
			<input type="text" id="mail"><br>
			<label>Enunciado de la pregunta:* </label>
			<input type="text" id="enunciado"><br>
			<label>Respuesta correcta*: </label>
			<input type="text" id="correcta"><br>
			<label>Respuesta incorrecta 1*: </label>
			<input type="text" id="inco1"><br>
			<label>Respuesta incorrecta 2*: </label>
			<input type="text" id="inco2"><br>
			<label>Respuesta incorrecta 3*: </label>
			<input type="text" id="inco3"><br>
			<label>Complejidad*: </label>
			<select id="complejidad">
					<option value="1">Baja</option>
					<option value="2">Media</option>
					<option value="3">Alta</option>
			</select> <br>
			<label>Tema*: </label>
			<input type="text" id="tema"><br>
		</form>
		<input type="button" value="Enviar pregunta" onclick="validar()"><br>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>
