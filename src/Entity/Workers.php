<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.09.2019
 * Time: 20:24
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Firms
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\WorkersRepository")
 */
class Workers
{

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var string|null
     *
     * @ORM\Column(name="fio", type="string", length=255, nullable=false)
     */
    private $fio;


    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;


    /**
     * @var Firms
     * @ORM\ManyToOne(targetEntity="Firms")
     * @ORM\JoinColumn(name="firmId", referencedColumnName="id")
     */
    private $firm;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFirm(): ?Firms
    {
        return $this->firm;
    }

    public function setFirm(?Firms $firm): self
    {
        $this->firm = $firm;

        return $this;
    }


}