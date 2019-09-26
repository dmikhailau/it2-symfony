<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Halls
 *
 * @ORM\Table(name="halls")
 * @ORM\Entity(repositoryClass="App\Repository\HallsRepository")
 */
class Halls
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="createdTs", type="datetime", nullable=true)
     */
    private $createdts;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updatedTs", type="datetime", nullable=true)
     */
    private $updatedts;


    /**
     * @var Seats|ArrayCollection[]
     * @ORM\OneToMany(targetEntity="Seats", mappedBy="hall")
     */
    protected $seats;

    /**
     * Halls constructor.
     * @param $seats
     */
    public function __construct()
    {
        $this->seats = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedts(): ?\DateTimeInterface
    {
        return $this->createdts;
    }

    public function setCreatedts(?\DateTimeInterface $createdts): self
    {
        $this->createdts = $createdts;

        return $this;
    }

    public function getUpdatedts(): ?\DateTimeInterface
    {
        return $this->updatedts;
    }

    public function setUpdatedts(?\DateTimeInterface $updatedts): self
    {
        $this->updatedts = $updatedts;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getSeats()
    {
        return $this->seats;
    }

    public function addSeat(Seats $seat): self
    {
        if (!$this->seats->contains($seat)) {
            $this->seats[] = $seat;
            $seat->setHall($this);
        }

        return $this;
    }

    public function removeSeat(Seats $seat): self
    {
        if ($this->seats->contains($seat)) {
            $this->seats->removeElement($seat);
            // set the owning side to null (unless already changed)
            if ($seat->getHall() === $this) {
                $seat->setHall(null);
            }
        }

        return $this;
    }
}


