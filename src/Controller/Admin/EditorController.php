<?php

namespace App\Controller\Admin;

use App\Entity\Editor;
use App\Form\EditorType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/editor')] // Attention minuscule par convention.
final class EditorController extends AbstractController
{
    #[Route('', name: 'app_admin_editor_index')] //  Convention: *_index pour l’index.
    public function index(): Response
    {
        return $this->render('admin/editor/index.html.twig', [
            'controller_name' => 'EditorController',
        ]);
    }

    #[Route('/new', name: 'app_admin_editor_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $editor = new Editor();

        $form = $this->createForm(EditorType::class, $editor);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // (sauvegarde à faire dans l’étape suivante du cours)
        }

        return $this->render('admin/editor/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}