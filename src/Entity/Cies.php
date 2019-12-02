<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiesRepository")
 * @Vich\Uploadable
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="uploads", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;


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
        $this->image = new EmbeddedFile();
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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
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
