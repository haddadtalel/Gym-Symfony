<?php

namespace App\Entity;

use App\Repository\InstructorsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; // Import the correct Collection interface
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstructorsRepository::class)]
class Instructors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $spec = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(nullable: true)]
    private ?int $phone_number = null;

    /**
     * @var Collection<int, Classes>
     */
    #[ORM\OneToMany(mappedBy: 'instructor', targetEntity: Classes::class)]
    private Collection $classes;

    public function __construct()
    {
        // Initialize the classes property as an ArrayCollection
        $this->classes = new ArrayCollection();
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?int $phone_number): static
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSpec(): ?string
    {
        return $this->spec;
    }

    public function setSpec(string $spec): static
    {
        $this->spec = $spec;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classes $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setInstructor($this); // Ensure bidirectional relationship is maintained
        }

        return $this;
    }

    public function removeClass(Classes $class): static
    {
        if ($this->classes->removeElement($class)) {
            // Ensure the owning side is also updated
            if ($class->getInstructor() === $this) {
                $class->setInstructor(null);
            }
        }

        return $this;
    }
}
