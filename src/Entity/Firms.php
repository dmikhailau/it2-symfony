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
 * @ORM\Entity(repositoryClass="App\Repository\FirmsRepository")
 */
class Firms
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;


    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }


}