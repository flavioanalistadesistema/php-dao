<?php

class Usuarios
{
    private $sql;
    private $iduser;
    private $deslogin;
    private $despassword;
    private $dtregister;

    public function getIduser()
    {
        return $this->iduser;
    }

    public function setIduser($iduser)
    {
        return $this->iduser = $iduser;
    }

    public function getDeslogin()
    {
        return $this->deslogin;
    }

    public function setDeslogin($deslogin)
    {
        return $this->deslogin = $deslogin;
    }
    
    public function getDespassword()
    {
        return $this->despassword;
    }

    public function setDespassword($despassword)
    {
        return $this->despassword = $despassword;
    }

    public function getDtregister()
    {
        return $this->dtregister;
    }

    public function setDtregister($dtregister)
    {
        return $this->dtregister = $dtregister;
    }

    public function __construct()
    {
        $this->sql = new Sql();
    }

    public function loadById($id)
    {
        $usuario = $this->sql->select("SELECT * FROM tb_usuarios WHERE iduser = :ID", [
            ":ID"=> $id
        ]);

        if (count($usuario) > 0) {

            $this->setData($usuario[0]);
        }
    }

    public static function getList()
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios order by iduser");
        return json_encode($result);
    }

    public static function search($login)
    {
        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY iduser", array(
            ":SEARCH" => "%". $login ."%" 
        ));
        return json_encode($result);
    }

    public function login($login, $despassword)
    {
        $usuario = $this->sql->select("SELECT * FROM tb_usuarios WHERE deslogin =:DESLOGIN and despassword =:DESPASSORD", [
            ':DESLOGIN' => $login,
            ':DESPASSORD' => $despassword
        ]);
   
        if (count($usuario) > 0) {

            $this->setData($usuario[0]);
        }
    }

    public function insert()
    {
        $result = $this->sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", [
            ':LOGIN' => $this->getDeslogin(),
            ':PASSWORD' => $this->getDespassword()
        ]);

        if (count($result) > 0) {
            
            $this->setData($result[0]);

        }
    }

    public function update($login, $senha)
    {
        $this->setDeslogin($login);
        $this->setDespassword($senha);

        $this->sql->query("UPDATE tb_usuarios SET deslogin =:DESLOGIN, despassword =:DESPASSORD where iduser =:ID", [
            ':DESLOGIN' => $this->getDeslogin(),
            ':DESPASSORD' => $this->getDespassword(),
            ':ID' => $this->getIduser()
        ]);

    }

    public function delete()
    {
        $result =  $this->sql->query("DELETE FROM tb_usuarios where iduser=:ID", [
            ':ID' => $this->getIduser()
        ]);

        $this->setIduser(0);
        $this->setDeslogin('');
        $this->setDespassword('');
        $this->setDtregister(new datetime());
    }

    public function setData($data)
    {
        $this->setIduser($data['iduser']);
        $this->setDeslogin($data['deslogin']); 
        $this->setDespassword($data['despassword']);
        $this->setDtregister(new datetime($data['dtregister']));
    }

    public function __toString()
    {
        return json_encode(array(
            'Id'=> $this->getIduser(),
            'Login'=> $this->getDeslogin(),
            'Senha'=> $this->getDespassword(),
            'Data'=> $this->getDtregister()->format('d/m/Y H:i:s')
        ));
    }

}