<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;

#[Route('/api/books', name: 'api_books_', format: 'json')]
final class BookController extends AbstractController
{
    //Find all books
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(BookRepository $repository): JsonResponse
    {
        $books = $repository->findAll();
        if (!$books) {
            return $this->json(['message' => 'No books found'], 404);
        }
        return $this->json($books);
    }

    //books stats
    #[Route('/stats', name: 'stats', methods: ['GET'])]
    public function stats(BookRepository $repository): JsonResponse
    {
        return $this->json([
            'total' => $repository->count([]),
            'read' => $repository->count(['read' => true]),
            'unread' => $repository->count(['read' => false]),
        ]);
    }
    
    //Find a book by id
    #[Route('/{id}', name: 'show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id, BookRepository $repository): JsonResponse
    {
        $book = $repository->find($id);
        if (!$book) {
            return $this->json(['message' => 'Book not found'], 404);
        }
        return $this->json($book);
    }
}
