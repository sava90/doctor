<?php

namespace App\Entity;

use App\Repository\DiseaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiseaseRepository::class)
 */
class Disease
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned" : true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Drug", inversedBy="diseases", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="diseases_drugs",
     *     joinColumns={@ORM\JoinColumn(name="disease_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="drug_id", referencedColumnName="id")}
     *     )
     */
    private $drugs;

    public function __construct() {
        $this->drugs = new ArrayCollection();
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

    /**
     * @return Collection|Drug[]
     */
    public function getDrugs(): Collection
    {
        return $this->drugs;
    }

    public function addDrug(Drug $drug): self
    {
        $this->drugs->add($drug);

        return $this;
    }

    public function removeDrug(Drug $drug): self
    {
        if ($this->drugs->contains($drug)) {
            $this->drugs->removeElement($drug);
        }

        return $this;
    }
}
