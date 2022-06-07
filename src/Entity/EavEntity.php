<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: [
        'skip_null_values' => false,
        'groups' => ['entity.read']
    ],
    denormalizationContext: ['groups' => ['entity.create']],
    collectionOperations: ['get', 'post'],
    itemOperations: ['delete', 'get', 'patch'],
)]
class EavEntity
{
    #[
        ORM\Id,
        ORM\Column,
        ORM\GeneratedValue
    ]
    private ?int $id = null;

    #[
        ORM\ManyToOne(targetEntity: EavEntityType::class, inversedBy: 'entities'),
        Assert\NotNull
    ]
    private EavEntityType $type;

    //// ORM\OneToMany(mappedBy: 'entity', targetEntity: EavAttribute::class, cascade: ['all']),
    #[
        Groups(['entity.read'])
    ]
    private iterable $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EavEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): EavEntityType
    {
        return $this->type;
    }

    public function setType(EavEntityType $type): EavEntity
    {
        $this->type = $type;
        return $this;
    }

    public function getAttributes(): iterable
    {
        return $this->attributes;
    }
}
