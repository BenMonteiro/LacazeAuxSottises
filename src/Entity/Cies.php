<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiesRepository")
 */
class Cies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $place;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $audience;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $furtherInfos;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoLink;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inCreation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inDiffusion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fest;

    /**
     * @ORM\Column(type="boolean")
     */
    private $season;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CieDates", mappedBy="cies", orphanRemoval=true)
     */
    private $dates;

    public function __construct()
    {
        $this->dates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAudience(): ?string
    {
        return $this->audience;
    }

    public function setAudience(string $audience): self
    {
        $this->audience = $audience;

        return $this;
    }

    public function getFurtherInfos(): ?string
    {
        return $this->furtherInfos;
    }

    public function setFurtherInfos(?string $furtherInfos): self
    {
        $this->furtherInfos = $furtherInfos;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(?string $webSite): self
    {
        $this->webSite = $webSite;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->videoLink;
    }

    public function setVideoLink(?string $videoLink): self
    {
        $this->videoLink = $videoLink;

        return $this;
    }

    public function getInCreation(): ?bool
    {
        return $this->inCreation;
    }

    public function setInCreation(bool $inCreation): self
    {
        $this->inCreation = $inCreation;

        return $this;
    }

    public function getInDiffusion(): ?bool
    {
        return $this->inDiffusion;
    }

    public function setInDiffusion(bool $inDiffusion): self
    {
        $this->inDiffusion = $inDiffusion;

        return $this;
    }

    public function getFest(): ?bool
    {
        return $this->fest;
    }

    public function setFest(bool $fest): self
    {
        $this->fest = $fest;

        return $this;
    }

    public function getSeason(): ?bool
    {
        return $this->season;
    }

    public function setSeason(bool $season): self
    {
        $this->season = $season;

        return $this;
    }

    /**
     * @return Collection|CieDates[]
     */
    public function getDates(): Collection
    {
        return $this->dates;
    }

    public function addDate(CieDates $date): self
    {
        if (!$this->dates->contains($date)) {
            $this->dates[] = $date;
            $date->setCies($this);
        }

        return $this;
    }

    public function removeDate(CieDates $date): self
    {
        if ($this->dates->contains($date)) {
            $this->dates->removeElement($date);
            // set the owning side to null (unless already changed)
            if ($date->getCies() === $this) {
                $date->setCies(null);
            }
        }

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
