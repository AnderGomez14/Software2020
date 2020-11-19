ContraValid = new XMLHttpRequest();
ContraValid.onreadystatechange = function () {
    if (ContraValid.readyState == 4) {
        var obj = document.getElementById('PASS');
        alert(ContraValid.responseText);
        if(ContraValid.responseText == 'SI'){
            obj.style.color = 'yellow';
            obj.innerHTML = 'Contraseña Valida';
        } else {
            obj.style.color = 'red';
            obj.innerHTML = 'Contraseña Invalida';
        }     
    }
}
function passValid(contrasena) {
    ContraValid.open("GET", "../php/ClientVerifyPass.php?contrasena="+contrasena, true);
    ContraValid.send();
}