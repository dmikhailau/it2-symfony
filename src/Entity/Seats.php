<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seats
 *
 * @ORM\Table(name="seats", indexes={@ORM\Index(name="type_id", columns={"type_id"}), @ORM\Index(name="hall_id", columns={"hall_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\SeatsRepository")
 */
class Seats
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
     * @ORM\Column(name="number", type="string", length=255, nullable=true)
     */
    private $number;

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
     * @var \Halls
     *
     * @ORM\ManyToOne(targetEntity="Halls", inversedBy="seats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hall_id", referencedColumnName="id")
     * })
     */
    private $hall;

    /**
     * @var \SeatTypes
     *
     * @ORM\ManyToOne(targetEntity="SeatTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

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

    public function getHall(): ?Halls
    {
        return $this->hall;
    }

    public function setHall(?Halls $hall): self
    {
        $this->hall = $hall;

        return $this;
    }

    public function getType(): ?SeatTypes
    {
        return $this->type;
    }

    public function setType(?SeatTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

}
