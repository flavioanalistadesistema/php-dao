<?php

class Usuarios
{
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

    public function loadById($id)
    {
        $sql = new Sql();
        $usuario = $sql->select("SELECT * FROM tb_usuarios WHERE iduser = :ID", [
            ":ID"=> $id
        ]);

        if (count($usuario) > 0) {
            $row = $usuario[0];
            $this->setIduser($row['iduser']);
            $this->setDeslogin($row['deslogin']); 
            $this->setDespassword($row['despassword']);
            $this->setDtregister(new datetime($row['dtregister']));
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
        $sql = new Sql();
        $usuario = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin =:DESLOGIN and despassword =:DESPASSORD", [
            ':DESLOGIN' => $login,
            ':DESPASSORD' => $despassword
        ]);
   
        if (count($usuario) > 0) {
            $row = $usuario[0];
            $this->setIduser($row['iduser']);
            $this->setDeslogin($row['deslogin']); 
            $this->setDespassword($row['despassword']);
            $this->setDtregister(new datetime($row['dtregister']));
        }else {
            throw new Exception("Erro na senha e/ou login");
        }
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