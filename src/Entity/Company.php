<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Service\FindUrlService;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @Vich\Uploadable
 */
class Company
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"autocomplete"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Groups({"autocomplete"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="company_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     * @Assert\Image
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
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $videoLink;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Performance", mappedBy="company", cascade="all", orphanRemoval=true)
     */
    private $performances;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $audience;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $moreInfos;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     */
    private $duration;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $showTitle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHosted;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $isHostedFrom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $isHostedUntil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isHidden;

    public function __construct()
    {
        $this->performances = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

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

    /**
     * @return Collection|Performance[]
     */
    public function getPerformances(): Collection
    {
        return $this->performances;
    }

    public function addPerformance(Performance $performance): self
    {
        $performance->setcompany($this);
        $this->performances->add($performance);

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->contains($performance)) {
            $this->performances->removeElement($performance);
            // set the owning side to null (unless already changed)
            if ($performance->getcompany() === $this) {
                $performance->setcompany(null);
            }
        }

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

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

    public function getMoreInfos(): ?string
    {
        return $this->moreInfos;
    }

    public function setMoreInfos(?string $moreInfos): self
    {
        $this->moreInfos = $moreInfos;

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

    public function getShowTitle(): ?string
    {
        return $this->showTitle;
    }

    public function setShowTitle(?string $showTitle): self
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    public function getIsHosted(): ?bool
    {
        return $this->isHosted;
    }

    public function setIsHosted(bool $isHosted): self
    {
        $this->isHosted = $isHosted;

        return $this;
    }

    public function getIsHostedFrom(): ?\DateTimeInterface
    {
        return $this->isHostedFrom;
    }

    public function setisHostedFrom(?\DateTimeInterface $isHostedFrom): self
    {
        $this->isHostedFrom = $isHostedFrom;

        return $this;
    }

    public function getisHostedUntil(): ?\DateTimeInterface
    {
        return $this->isHostedUntil;
    }

    public function setisHostedUntil(?\DateTimeInterface $isHostedUntil): self
    {
        $this->isHostedUntil = $isHostedUntil;

        return $this;
    }

    public function getImageDescription(): ?string
    {
        return $this->imageDescription;
    }

    public function setImageDescription(?string $imageDescription): self
    {
        $this->imageDescription = $imageDescription;

        return $this;
    }

    public function getIsHidden(): ?bool
    {
        return $this->isHidden;
    }

    public function setIsHidden(bool $isHidden): self
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    public function __toString()
    {
        $findUrlService = new FindUrlService;
        $url = $findUrlService->findUrl();

        if (preg_match('#festival/cies-accueillies#', $url)) {
            if ($this->showTitle !== null) {
                return $this->showTitle;
            } else {
                return $this->name;
            }
        } else {
            return $this->name;
        }
    }
}
