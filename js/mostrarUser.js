MostrarUser = new XMLHttpRequest();
MostrarUser.onreadystatechange = function () {
    if (MostrarUser.readyState == 4) {
        var newData = JSON.stringify(this.responseText);
        var data2 = JSON.parse(newData);
        var data = JSON.parse(data2);
        if(data.nEstado == "A")
            document.getElementById('CambiarEstado').innerHTML= 'Bloquear';
        else
            document.getElementById('CambiarEstado').innerHTML= 'Activar';
        var obj = document.getElementById('mailAux');
        obj.innerHTML= data.nEmail;
        var obj1 = document.getElementById('passAux');
        obj1.innerHTML= data.nPassword;
        var obj2 = document.getElementById('fotoAux');
        if(data.nUsers == '-')
        obj2.innerHTML= "Usuario sin Fotografia";
        else
        obj2.innerHTML= "Foto";//src= data.nUsers;
    }
}
function valor(email) {
    MostrarUser.open("GET", "../php/mostrarUser.php?email=" + email, true);
    MostrarUser.send();
}