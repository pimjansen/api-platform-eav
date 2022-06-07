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
        'groups' => ['entityType.read']
    ],
    collectionOperations: ['get', 'post'],
    itemOperations: ['delete', 'get', 'patch'],
)]
class EavEntityType
{
    #[
        ORM\Id,
        ORM\Column,
        ORM\GeneratedValue
    ]
    private ?int $id = null;

    #[
        ORM\Column,
        Assert\NotBlank,
        Groups(['entityType.read'])
    ]
    private string $name = '';

    #[
        ORM\OneToMany(mappedBy: 'type', targetEntity: EavEntity::class, cascade: ['all'])
    ]
    private iterable $entities;

    public function __construct()
    {
        $this->entities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EavEntityType
    {
        $this->name = $name;
        return $this;
    }

    public function getEntities(): iterable
    {
        return $this->entities;
    }
}
