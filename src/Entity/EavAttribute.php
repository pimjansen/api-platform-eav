<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    denormalizationContext: ['groups' => ['attribute.create']],
    normalizationContext: [
        'skip_null_values' => false,
        'groups' => ['attribute.read']
    ],
    collectionOperations: ['post'],
    itemOperations: ['get'],
)]
class EavAttribute
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
        Groups(['entity.read', 'attribute.create', 'attribute.read'])
    ]
    private string $name = '';

    #[
        ORM\ManyToOne(targetEntity: EavEntityType::class, inversedBy: 'attributes'),
        Assert\NotNull,
        Groups(['attribute.create'])
    ]
    private EavEntityType $entityType;

    #[
        ORM\OneToMany(targetEntity: EavAttributeValue::class, mappedBy: 'attribute', fetch: 'EXTRA_LAZY'),
    ]
    private iterable $values;

    #[
        Groups(['entity.read', 'attribute.read'])
    ]
    private mixed $value;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EavAttribute
    {
        $this->name = $name;
        return $this;
    }

    public function getEntityType(): EavEntityType
    {
        return $this->entityType;
    }

    public function setEntityType(EavEntityType $entityType): EavAttribute
    {
        $this->entityType = $entityType;
        return $this;
    }

    public function getValues(): iterable
    {
        return $this->values;
    }

    public function getValue(): mixed
    {
        return $this->values[0]?->getValue();
    }
}
