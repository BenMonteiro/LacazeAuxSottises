<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerformanceRepository")
 */
class Performance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="performances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cityShow;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeShow;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="performances")
     * @ORM\JoinColumn(nullable=true)
     */
    private $event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?Company
    {
        return $this->companyName;
    }

    public function setCompanyName(?Company $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getCityShow(): ?string
    {
        return $this->cityShow;
    }

    public function setCityShow(string $cityShow): self
    {
        $this->cityShow = $cityShow;

        return $this;
    }

    public function getPlaceShow(): ?string
    {
        return $this->placeShow;
    }

    public function setPlaceShow(string $placeShow): self
    {
        $this->placeShow = $placeShow;

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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
