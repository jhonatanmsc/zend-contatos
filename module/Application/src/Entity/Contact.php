<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Address\src\Entity\Address;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $descr;

    /**
     * @ORM\OneToOne(targetEntity="Address", inversedBy="contact", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;

    public function __construct() {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getDescr()
    {
        return $this->descr;
    }
    
    public function getAddress()
    {
        return $this->address;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function setCreatedAt($now)
    {
        $this->created_at = $now;
    }
    public function setUpdatedAt($now)
    {
        $this->updated_at = $now;
    }
    
}