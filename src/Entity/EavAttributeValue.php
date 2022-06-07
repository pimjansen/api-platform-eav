<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Attribute;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    collectionOperations: [],
    itemOperations: ['get'],
)]
class EavAttributeValue
{
    #[
        ORM\Id,
        ORM\Column,
        ORM\GeneratedValue
    ]
    private ?int $id = null;

    #[
        ORM\ManyToOne(targetEntity: EavAttribute::class),
    ]
    private EavAttribute $attribute;

    #[
        Groups(['entity.read', 'attribute.read'])
    ]
    private mixed $value;

    #[
        ORM\Column(type: 'string', nullable: true),
    ]
    private ?string $valueString = null;

    #[
        ORM\Column(type: 'datetime', nullable: true),
    ]
    private ?DateTimeInterface $valueDate = null;

    #[
        ORM\Column(type: 'integer', nullable: true),
    ]
    private ?int $valueInt = null;

    #[
        ORM\Column(type: 'boolean', nullable: true),
    ]
    private ?bool $valueBool = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): mixed
    {
        return $this->valueString
            ?? $this->valueInt
            ?? $this->valueDate
            ?? $this->valueBool;
    }

    public function getValueString()
    {
        return $this->getValue();
    }

    public function setValue(mixed $value): mixed
    {
        // $this->name = $value;
        return $this;
    }

    public function getAttribute(): EavAttribute
    {
        return $this->attribute;
    }
}
