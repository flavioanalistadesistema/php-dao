<?php

require_once('config.php');

$usuario = new Usuarios();
$usuario->loadById(20);

echo $usuario;


