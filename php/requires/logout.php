<?php
session_start();
session_unset();
session_destroy();
echo "Cerrar Sesion";
echo '<meta http-equiv="refresh" content="5;url=./">';
exit();
