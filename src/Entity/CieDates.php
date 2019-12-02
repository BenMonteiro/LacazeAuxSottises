<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CieDatesRepository")
 */
class CieDates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cies", inversedBy="dates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cies;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCies(): ?Cies
    {
        return $this->cies;
    }

    public function setCies(?Cies $cies): self
    {
        $this->cies = $cies;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function __toString()
    {
    // to show the name of the Category in the select
    return $this->name;
    // to show the id of the Category in the select
    // return $this->id;
    }
}
