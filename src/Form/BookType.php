<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Enum\BookStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// Types de base
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('isbn', TextType::class, [
                'label' => 'ISBN',
            ])
            ->add('cover', UrlType::class, [
                'label'    => 'Illustration (URL)',
                'required' => false,
            ])
            ->add('editedAt', DateTimeType::class, [
                'input'  => 'datetime_immutable',
                'widget' => 'single_text',
                'label'  => 'Date d’édition',
            ])
            ->add('plot', TextareaType::class, [
                'label'    => 'Résumé',
                'required' => false,
            ])
            ->add('pageNumber', IntegerType::class, [
                'label' => 'Nombre de pages',
                'attr'  => ['min' => 1],
            ])
            ->add('status', EnumType::class, [
                'class'        => BookStatus::class,
                // si tu as getLabel() dans l’enum :
                // 'choice_label' => fn(BookStatus $s) => $s->getLabel(),
                'label'        => 'Statut',
            ])
            ->add('editor', EntityType::class, [
                'class'        => Editor::class,
                'choice_label' => 'name',
                'placeholder'  => '— Choisir un éditeur —',
                'label'        => 'Éditeur',
            ])
            ->add('authors', EntityType::class, [
                'class'        => Author::class,
                'choice_label' => 'name',
                'multiple'     => true,
                'by_reference' => false, // ManyToMany : utilise addAuthor()/removeAuthor()
                'label'        => 'Auteurs',
    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}