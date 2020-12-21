<?php
session_start();
if (isset($_SESSION['social']))
    echo '<script>
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut();
    </script>';
session_destroy();
echo '<script>alert("Ha cerrado sesion, vuelva pronto.");window.location.href = "Layout.php";</script>';
