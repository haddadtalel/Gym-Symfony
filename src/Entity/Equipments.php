<?php

namespace App\Entity;

use App\Repository\EquipmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentsRepository::class)]
class Equipments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 100)]
    private ?string $type = null;

    #[ORM\Column(length: 100)]
    private ?string $Eqcondition = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $last_maint_date = null;

    /**
     * @var Collection<int, Classes>
     */
    #[ORM\ManyToMany(targetEntity: Classes::class)]
    private Collection $class;

    public function __construct()
    {
        $this->class = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getEqcondition(): ?string
    {
        return $this->Eqcondition;
    }

    public function setEqcondition(string $Eqcondition): static
    {
        $this->Eqcondition = $Eqcondition;

        return $this;
    }

    public function getLastMaintDate(): ?\DateTimeInterface
    {
        return $this->last_maint_date;
    }

    public function setLastMaintDate(?\DateTimeInterface $last_maint_date): static
    {
        $this->last_maint_date = $last_maint_date;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClass(): Collection
    {
        return $this->class;
    }

    public function addClass(Classes $class): static
    {
        if (!$this->class->contains($class)) {
            $this->class->add($class);
        }

        return $this;
    }

    public function removeClass(Classes $class): static
    {
        $this->class->removeElement($class);

        return $this;
    }
}
