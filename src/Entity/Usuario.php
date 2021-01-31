<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
* @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
*/
class Usuario implements UserInterface, \Serializable
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;
    /**
    * @ORM\Column(type="string", length=100)
    */
    private $login;
    /**
    * @ORM\Column(type="string", length=100)
    */
    private $password;
    /**
    * @ORM\Column(type="string", length=100)
    */
    private $email;
    /**
    * @ORM\Column(type="string", length=20)
    */
    private $rol;
    public function getUserName()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getSalt()
    {
        return null;
    }
    public function getRoles()
    {
        return array($this->rol);
    }
    public function eraseCredentials()
        {
        }
    public function serialize()
    {
        return serialize(array(
        $this->id,
        $this->login,
        $this->password
        ));
    }
    public function unserialize($datos_serializados)
    {
        list(
        $this->id,
        $this->login,
        $this->password
        ) = unserialize($datos_serializados,
        array('allowed_classes' => false));
    }
}
?>