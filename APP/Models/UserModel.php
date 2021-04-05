<?php
namespace Models;

class UserModel
{
    /**
     * @var string
     */
    private $NombreUsuario;
    /**
    * @var string
    */
    private $Apellido;
    /**
     * @var string
     */
    private $Mail;
    /**
     * @var string
     */
    private $Password;

    public function setNombreUsuario(string $NombreUsuario)
    {
        $this->NombreUsuario = $NombreUsuario;
    }
    public function getNombreUsuario(): string
    {
        return $this->NombreUsuario;
    }
    public function setApellido(string $Apellido)
    {
        $this->Apellido = $Apellido;
    }
    public function getApellido(): string
    {
        return $this->Apellido;
    }
    public function setMail(string $Mail)
    {
        $this->Mail = $Mail;
    }
    public function getMail(): string
    {
        return $this->Mail;
    }
    public function setPassword(string $Password)
    {
        $this->Password = $Password;
    }
    public function getPassword(): string
    {
        return $this->Password;
    }
}