<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductVariantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductVariantRepository::class)]
#[ApiResource(
    collectionOperations: ['GET'],
    itemOperations: ['GET'],
    normalizationContext: ['groups' => ['product:get']],
)]
class ProductVariant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(inversedBy: 'variants')]
    #[ORM\JoinColumn(nullable: false)]
    private Product $product;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['product:get', 'category:get'])]
    private string $value;

    #[ORM\Column(type: 'smallint', options: ['default' => 0])]
    #[Groups('product:get')]
    private int $qtyInStock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getQtyInStock(): ?int
    {
        return $this->qtyInStock;
    }

    public function setQtyInStock(int $qtyInStock): void
    {
        $this->qtyInStock = $qtyInStock;
    }
}
