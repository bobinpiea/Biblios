<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

// On crée le formulaire lié à l’entité Author
class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ texte simple pour le nom de l’auteur lié à cette class/champ
            ->add('name', TextType::class, [
                'label' => 'Nom de l’auteur',
            ])

            // Champ de type Date pour la date de naissance
            // input = datetime_immutable → correspond au type utilisé dans l’entité
            // widget = single_text → un seul input HTML5 <input type="date">
            ->add('dateOfBirth', DateType::class, [
                'input'  => 'datetime_immutable',
                'widget' => 'single_text',
                'label'  => 'Date de naissance',
            ])

            // Même logique pour dateOfDeath
            // required = false → champ non obligatoire (auteur encore vivant possible)
            ->add('dateOfDeath', DateType::class, [
                'input'    => 'datetime_immutable',
                'widget'   => 'single_text',
                'required' => false,
                'label'    => 'Date de décès',
            ])

            // Champ texte libre pour la nationalité
            // required = false → on n’est pas obligé de remplir
            ->add('nationality', TextType::class, [
                'required' => false,
                'label'    => 'Nationalité',
            ])

            // Champ relation vers Book (EntityType)
            // class = Book::class → entité cible
            // choice_label = 'title' → ce qui s’affiche dans la liste (titre du livre)
            // multiple = true → un auteur peut avoir plusieurs livres
            // required = false → pas obligatoire de lier un livre
            ->add('books', EntityType::class, [
                'class'        => Book::class,
                'choice_label' => 'title',
                'multiple'     => true,
                'required'     => false,
                'label'        => 'Livres associés',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // On relie ce formulaire à l’entité Author
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}