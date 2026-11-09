<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;

#[Route('/api/books', name: 'api_books_', format: 'json')]
final class BookController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(BookRepository $repository): JsonResponse
    {
       $books = $repository->findAll();
       if (!$books) {
           return $this->json(['message' => 'No books found'], 404);
       }
       return $this->json($books);
    }
}
