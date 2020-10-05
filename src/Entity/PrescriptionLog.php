<?php

namespace App\Entity;

use App\Repository\PrescriptionLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrescriptionLogRepository::class)
 */
class PrescriptionLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Disease", inversedBy="prescriptionLog", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="disease_id", referencedColumnName="id", unique=false, nullable=false)
     */
    private $disease;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDisease(): ?Disease
    {
        return $this->disease;
    }

    public function setDisease(Disease $disease): self
    {
        $this->disease = $disease;

        return $this;
    }
}
