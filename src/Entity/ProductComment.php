<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductCommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductCommentRepository::class)]
#[ApiResource(
    collectionOperations: ['GET', 'POST'],
    itemOperations: ['GET'],
    denormalizationContext: ['groups' => ['comment:post']],
    normalizationContext: ['groups' => ['product:get']],
)]
class ProductComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('comment:post')]
    private Product $product;

    #[ORM\Column(length: 255)]
    #[Groups(['product:get', 'comment:post'])]
    private string $author;

    #[ORM\Column(type: 'text')]
    #[Groups(['product:get', 'comment:post'])]
    private string $comment;

    #[ORM\Column(type: 'datetime')]
    #[Groups('product:get')]
    private \DateTime $date;

    #[ORM\Column(type: 'smallint', options: ['default' => 0])]
    #[Groups(['product:get', 'comment:post'])]
    private int $note = 0;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): void
    {
        $this->note = $note;
    }
}
