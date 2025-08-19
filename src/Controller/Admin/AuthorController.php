<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/author')] // préfixe commun aux routes de ce contrôleur
final class AuthorController extends AbstractController
{
    #[Route('', name: 'app_admin_author_index')]
    public function index(): Response
    {
        // page d’accueil des auteurs (liste à venir)
        return $this->render('admin/author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/new', name: 'app_admin_author_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        // 1) entité support du formulaire
        $author = new Author();

        // 2) formulaire lié à l’entité
        $form = $this->createForm(AuthorType::class, $author);

        // 3) lie la requête (GET/POST) et hydrate $author en cas de POST
        $form->handleRequest($request);

        // 4) si soumis et valide → (on fera persist/flush juste après)
        if ($form->isSubmitted() && $form->isValid()) {
           $manager->persist($author);
           $manager->flush();
           // les données de $author sont maintenant dans la base de données


           return $this->redirectToRoute(route:'app_admin_author_index');
        }

        // 5) IMPORTANT : passer une FormView à Twig
        return $this->render('admin/author/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}