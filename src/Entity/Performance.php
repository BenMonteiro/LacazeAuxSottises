<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="performances", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $company;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="performances", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHighlight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsHighlight(): ?bool
    {
        return $this->isHighlight;
    }

    public function setIsHighlight(bool $isHighlight): self
    {
        $this->isHighlight = $isHighlight;

        return $this;
    }

    public function __toString()
    {
        $event = $this->getEvent()->getName();
        return $event;
    }
}
