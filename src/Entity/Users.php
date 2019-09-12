<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Roles;
/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="parentId", type="string", length=255, nullable=true)
     */
    private $parentid;



    /**
     * @var Roles
     *
     * @ORM\ManyToOne(targetEntity="Roles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="roleId", referencedColumnName="id", onDelete="CASCADE", )
     * })
     */
    private $roleid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getParentid(): ?string
    {
        return $this->parentid;
    }

    public function setParentid(?string $parentid): self
    {
        $this->parentid = $parentid;

        return $this;
    }

    public function getRoleid(): ?Roles
    {
        return $this->roleid;
    }

    public function setRoleid(?Roles $roleid): self
    {
        $this->roleid = $roleid;

        return $this;
    }

}
