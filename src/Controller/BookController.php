<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository,
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
    ) {
    }

    #[Route('/', name: 'app_book_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $query = $this->bookRepository->createFindAllQuery();

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        $pagination->setCustomParameters([
            'align' => 'center',
            'size' => 'small',
            'style' => 'bottom',
        ]);

        return $this->render('book/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {

            $authorsData = $form->get('authors')->getData();
    
            // Iterate through authors
            foreach ($authorsData as $authorData) {
                $authorFirstName = $authorData->getFirstName();
                $authorLastName = $authorData->getLastName();
    
                // Check if the author exists
                $author = $entityManager
                    ->getRepository(Author::class)
                    ->findOneBy(['firstName' => $authorFirstName, 'lastName' => $authorLastName]);
    
                if (!$author) {
                    // If no author, create new one
                    $author = new Author();
                    $author->setFirstName($authorFirstName);
                    $author->setLastName($authorLastName);
                }

                // Associate book with author
                $entityManager->persist($author);
                $book->addAuthor($author);
            }
    
            $publisherName = $form->get('publisher')->get('name')->getData();
    
            $publisher = $entityManager
                ->getRepository(Publisher::class)
                ->findOneBy(['name' => $publisherName]);
    
            if (!$publisher) {
                $publisher = new Publisher();
                $publisher->setName($publisherName);
    
                $entityManager->persist($publisher);
            }

            $book->setPublisher($publisher);

            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
