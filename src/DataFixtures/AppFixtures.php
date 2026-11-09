<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = [
            ['Les Misérables', 'Victor Hugo', true, 5],
            // ... les trois autres livres : [titre, auteur, lu, note]
        ];
        foreach ($books as [$title, $author, $read, $rating]) {
            $book = new Book();
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setRead($read);
            $book->setRating($rating);
            $manager->persist($book);
        }
        $manager->flush();
    }
}
