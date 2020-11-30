MostrarUser = new XMLHttpRequest();
MostrarUser.onreadystatechange = function () {
    if (MostrarUser.readyState == 4) {
        var newData = JSON.stringify(this.responseText);
        var data = JSON.parse(newData);
        var obj = document.getElementById('mailAux');
        obj.innerHTML= data.nEmail;
        var obj1 = document.getElementById('passAux');
        obj.innerHTML= data.nPassword;
        var obj2 = document.getElementById('fotoAux');
        obj.innerHTML= data.nUsers;

    }
}
function valor(email) {
    MostrarUser.open("GET", "../php/mostrarUser.php?email=" + email, true);
    MostrarUser.send();
}