ContraValid = new XMLHttpRequest();
ContraValid.onreadystatechange = function () {
    if (ContraValid.readyState == 4) {
        var obj = document.getElementById('PASS');
        if (ContraValid.responseText == 'SI') {
            obj.style.color = 'yellow';
            obj.innerHTML = 'Contraseña Valida';
        } else if (ContraValid.responseText == 'NO') {
            obj.style.color = 'red';
            obj.innerHTML = 'Contraseña Invalida';
        } else {
            obj.style.color = 'brown';
            obj.innerHTML = 'Sin Servicio';
        }
    }
}
function passValid(contrasena) {
    ContraValid.open("GET", "../php/ClientVerifyPass.php?contrasena=" + contrasena + "&codigo=1010", true);
    ContraValid.send();
}