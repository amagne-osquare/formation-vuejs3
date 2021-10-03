<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    collectionOperations: ['GET'],
    itemOperations: ['GET'],
    normalizationContext: ['groups' => ['product:get']],
)]
#[ApiFilter(BooleanFilter::class, properties: ['featured'])]
class Product
{
    #[ORM\Id, ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column]
    #[Groups(['product:get', 'category:get'])]
    private ?string $name;

    #[ORM\Column(type: Types::INTEGER)]
    #[Groups(['product:get', 'category:get'])]
    private ?int $price;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['product:get'])]
    private ?string $details = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product:get', 'category:get'])]
    private ?string $imageUrl = null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    #[Groups(['product:get', 'category:get'])]
    private bool $inSale = false;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private bool $featured = false;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('product:get')]
    private Category $category;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductVariant::class, orphanRemoval: true)]
    #[Groups(['product:get', 'category:get'])]
    private Collection $variants;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductComment::class, orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->variants = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): void
    {
        $this->details = $details;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function isInSale(): bool
    {
        return $this->inSale;
    }

    public function setInSale(bool $inSale): void
    {
        $this->inSale = $inSale;
    }

    public function isFeatured(): bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return ProductVariant[]
     */
    public function getVariants(): array
    {
        return $this->variants->toArray();
    }

    public function addVariant(ProductVariant $variant): void
    {
        if (!$this->variants->contains($variant)) {
            $this->variants[] = $variant;
            $variant->setProduct($this);
        }
    }

    public function removeVariant(ProductVariant $variant): void
    {
        if ($this->variants->removeElement($variant) && $variant->getProduct() === $this) {
            $variant->setProduct(null);
        }
    }

    /**
     * @return Collection|ProductComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(ProductComment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }
    }

    public function removeComment(ProductComment $comment): void
    {
        if ($this->comments->removeElement($comment) && $comment->getProduct() === $this) {
            $comment->setProduct(null);
        }
    }
}
