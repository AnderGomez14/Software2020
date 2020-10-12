<!DOCTYPE html>
<html>
<head>
  <?php include '../html/Head.html'?>
</head>
<body>
  <?php include '../php/Menus.php' ?>
  <section class="main" id="s1">
    <div>
		<label>Email*: </label>
		<input type="text" id="email"><br>
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
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
		</select> <br>
		<label>Tema*: </label>
		<input type="text" id="tema"><br>
    </div>
  </section>
  <?php include '../html/Footer.html' ?>
</body>
</html>

