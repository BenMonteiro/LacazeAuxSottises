<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FrontPageRepository")
 */
class FrontPage
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
     * @ORM\ManyToOne(targetEntity="App\Entity\FrontTab", inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tab;

    /**
     * @ORM\Column(type="integer")
     */
    private $tabId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pageSlug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Section", mappedBy="belongToPage")
     */
    private $pageSections;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->pageSections = new ArrayCollection();
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

    public function getTab(): ?FrontTab
    {
        return $this->tab;
    }

    public function setTab(?FrontTab $tab): self
    {
        $this->tab = $tab;

        return $this;
    }

    public function getTabId(): ?int
    {
        return $this->tabId;
    }

    public function setTabId(int $tab): self
    {
        $this->tabId = $tab;

        return $this;
    }

    public function getPageSlug(): ?string
    {
        return $this->pageSlug;
    }

    public function setPageSlug(string $pageSlug): self
    {
        $this->pageSlug = $pageSlug;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getPageSections(): Collection
    {
        return $this->pageSections;
    }

    public function addPageSection(Section $pageSection): self
    {
        if (!$this->pageSections->contains($pageSection)) {
            $this->pageSections[] = $pageSection;
            $pageSection->setBelongToPage($this);
        }

        return $this;
    }

    public function removePageSection(Section $pageSection): self
    {
        if ($this->pageSections->contains($pageSection)) {
            $this->pageSections->removeElement($pageSection);
            // set the owning side to null (unless already changed)
            if ($pageSection->getBelongToPage() === $this) {
                $pageSection->setBelongToPage(null);
            }
        }

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }


    public function __toString()
    {
        return $this->pageSlug;
    }
}
