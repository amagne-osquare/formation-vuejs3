<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Zenstruck\Foundry\AnonymousFactory;

class CategoryController extends AbstractController
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/category/{id}', name: 'category')]
    public function index(int $id): Response
    {
        if (null === $category = $this->repository->find($id)) {
            throw $this->createNotFoundException('The category does not exist');
        }

        return $this->render('category/index.html.twig', [
            'title' => $category->getName(),
            'description' => AnonymousFactory::faker()->paragraph(6),
            'products' => $category->getProducts(),
        ]);
    }

    public function navbarCategories(): Response
    {
        $categories = $this->repository->findAll();

        return $this->render('header/_categories.html.twig', [
            'categories' => $categories,
        ]);
    }
}
