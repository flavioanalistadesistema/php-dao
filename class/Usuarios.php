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