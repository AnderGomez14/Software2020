AjaxVer = new XMLHttpRequest();
AjaxVer.onreadystatechange = function() {
    if (AjaxVer.readyState == 4) {
        var obj = document.getElementById('introducirBD');
        obj.innerHTML = AjaxVer.responseText;
    }
}
function verPreguntas(){
    AjaxVer.open("GET","../php/XMLVerPreguntas.php",true);
    AjaxVer.send();
}