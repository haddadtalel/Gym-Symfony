<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Type\PackTypeEnum;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, enumType: PackTypeEnum::class)]
    private PackTypeEnum $type;


    #[ORM\Column(length: 100 , enumType: PackTypeEnum::class)]
    private PackTypeEnum $duration;

    #[ORM\Column]
    private ?int $amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): PackTypeEnum
    {
        return $this->type;
    }

    public function setType(PackTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDuration(): PackTypeEnum
    {
        return $this->duration;
    }

    public function setDuration(PackTypeEnum $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
    public function __toString(): string
    {
    return sprintf(
        'Type: %s, Duration: %s, Amount: %d',
        $this->type->value ?? 'N/A',
        $this->duration->value ?? 'N/A',
        $this->amount ?? 0
    );
    }

}
