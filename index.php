<?php

require_once('config.php');

/* retonar somente um usuario
$usuario = new Usuarios();
$usuario->loadById(20);
echo $usuario;
*/

/* retornar uma lista de usuario
$userList = Usuarios::getList();
echo $userList;
*/

/* buscar usuarios filtro
$search = Usuarios::search('dflu');
echo $search;
*/

// loga usuario com login e senha
$usuario = new Usuarios();
$usuario->login('flaaps', 'e10adc3949ba59abbe56e057f20f883e');
echo $usuario;


