<?php

require_once('config.php');

/* retonar somente um usuario */
// $usuario = new Usuarios();
// $usuario->loadById(1);
// echo $usuario;


/* retornar uma lista de usuario */
// $userList = Usuarios::getList();
// echo $userList;

/* buscar usuarios filtro
$search = Usuarios::search('dflu');
echo $search;
*/

// loga usuario com login e senha
// $usuario = new Usuarios();
// $usuario->login('flaaos', '123');
// echo $usuario;

/** INSERIR DADOS E IMPRIMI-LO */
// $usuario = new Usuarios();
// $usuario->setDeslogin('Luciana');
// $usuario->setDespassword('45679');
// $usuario->insert();
// echo $usuario;

/**UPDATE - atualizando os dados do usuario */
// $user = new Usuarios();
// $user->loadById(2);
// $user->update('Flaviao', '!@#');
// echo $user;

/**DELETE - deletando usuario*/   

$user = new Usuarios();
$user->loadById(3);
$result = $user->delete();

echo $user;


