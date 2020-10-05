<?php

namespace App\Entity;

use App\Repository\DrugRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DrugRepository::class)
 */
class Drug
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
     * @ORM\ManyToMany(targetEntity="Disease", mappedBy="drugs", cascade={"persist", "remove"})
     */
    private $diseases;

    public function __construct() {
        $this->diseases = new ArrayCollection();
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

    public function addDisease(Disease $disease): self
    {
        $this->diseases->add($disease);

        return $this;
    }

    public function removeDisease(Disease $disease): self
    {
        if ($this->diseases->contains($disease)) {
            $this->diseases->removeElement($disease);
        }

        return $this;
    }
}
