ClienteVIP = new XMLHttpRequest();
ClienteVIP.onreadystatechange = function () {
    if (ClienteVIP.readyState == 4) {
        var obj = document.getElementById('VIP');
        if (ClienteVIP.responseText == 'SI') {
            obj.style.color = 'yellow';
            obj.innerHTML = 'El usuario es VIP';
        } else {
            obj.style.color = '#641E16';
            obj.innerHTML = 'El usuario NO es VIP';
        }
    }
}
function esVIP(email) {
    ClienteVIP.open("GET", "../php/ClientVerifyEnrollment.php?email=" + email, true);
    ClienteVIP.send();
}