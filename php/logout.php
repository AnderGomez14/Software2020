<?php
session_start();
session_destroy();
echo '<script>alert("Ha cerrado sesion, vuelva pronto.");window.location.href = "Layout.php";</script>';
