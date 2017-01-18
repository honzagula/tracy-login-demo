<?php
namespace App\Model\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User extends \Instante\Doctrine\Users\User
{
    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @param string $email
     * @param string $name
     * @param string $salt
     * @param string $password
     */
    public function __construct($email, $name, $salt, $password)
    {
        $this->name = $name;
        $this->email = $email;

        parent::__construct($salt, $password);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

}
