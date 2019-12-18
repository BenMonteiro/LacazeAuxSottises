<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 * @Vich\Uploadable
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startingDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endingDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hours;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="program_file", fileNameProperty="programPDF.name", size="programPDF.size", mimeType="programPDF.mimeType", originalName="programPDF.originalName")
     *
     * @Assert\File(
     *     mimeTypes = {"application/pdf", "application/x-pdf"}
     * )
     *
     * @var File
     */
    private $programPDFFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $programPDF;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="program_file", fileNameProperty="programImage.name", size="programImage.size", mimeType="programImage.mimeType", originalName="programImage.originalName")
     * 
     * @Assert\Image
     * 
     * @var File
     */
    private $programImageFile;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $programImage;

        /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Performance", mappedBy="event")
     */
    private $performances;

    public function __construct()
    {
        $this->programPDF = new EmbeddedFile();
        $this->programImage = new EmbeddedFile();
        $this->performances = new ArrayCollection();
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

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(?\DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(?\DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(?string $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $programPDFFile
     */
    public function setProgramPDFFile(?File $programPDFFile = null)
    {
        $this->programPDFFile = $programPDFFile;
        if (null !== $programPDFFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getProgramPDFFile(): ?File
    {
        return $this->programPDFFile;
    }

    public function setProgramPDF(EmbeddedFile $programPDF)
    {
        $this->programPDF = $programPDF;
    }

    public function getProgramPDF(): ?EmbeddedFile
    {
        return $this->programPDF;
    }

        /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $programImageFile
     */
    public function setProgramImageFile(?File $programImageFile = null)
    {
        $this->programImageFile = $programImageFile;
        if (null !== $programImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getProgramImageFile(): ?File
    {
        return $this->programImageFile;
    }

    public function setProgramImage(EmbeddedFile $programImage)
    {
        $this->programImage = $programImage;
    }

    public function getProgramImage(): ?EmbeddedFile
    {
        return $this->programImage;
    }

    public function __toString() {
        return $this->name;
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
        if (!$this->performances->contains($performance)) {
            $this->performances[] = $performance;
            $performance->setEvent($this);
        }

        return $this;
    }

    public function removePerformance(Performance $performance): self
    {
        if ($this->performances->contains($performance)) {
            $this->performances->removeElement($performance);
            // set the owning side to null (unless already changed)
            if ($performance->getEvent() === $this) {
                $performance->setEvent(null);
            }
        }

        return $this;
    }
}
