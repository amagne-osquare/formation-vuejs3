<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/product/{id}', name: 'product')]
    public function index(int $id): Response
    {
        if (null === $product = $this->repository->find($id)) {
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
        ]);
    }

    public function featuredProducts(): Response
    {
        $products = $this->repository->findBy(['featured' => true]);

        return $this->render('homepage/_featured.html.twig', [
            'products' => $products,
        ]);
    }
}
