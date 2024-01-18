<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/author')]
class AuthorController extends AbstractController
{
    public function __construct(
        private AuthorRepository $authorRepository,
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
        protected RequestStack $requestStack
    ) {
    }

    #[Route('/', name: 'app_author_index', methods: ['GET'])]
    public function index(): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $query = $this->authorRepository->createFindAllQuery();
    
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
    
        return $this->render('author/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_author_new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($author);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('author/new.html.twig', [
            'author' => $author,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_author_show', methods: ['GET'])]
    public function show(Author $author): Response
    {
        return $this->render('author/show.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_author_edit', methods: ['GET', 'POST'])]
    public function edit(Author $author): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_author_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('author/edit.html.twig', [
            'author' => $author,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_author_delete', methods: ['POST'])]
    public function delete(Author $author): Response
    {
        $request = $this->requestStack->getCurrentRequest();

        if ($this->isCsrfTokenValid('delete'.$author->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($author);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_author_index', [], Response::HTTP_SEE_OTHER);
    }
}
