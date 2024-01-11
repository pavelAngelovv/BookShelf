<?php

namespace App\Form;

use App\Entity\Book;
use App\Enum\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Book Title',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Book Description',
            ])
            ->add('releaseDate', DateType::class, [
                'label' => 'Release Date',
                'widget' => 'single_text', 
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('genres', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => array_combine(Genre::values(), Genre::values()),
                'label' => 'Genres',
            ])            
            ->add('authors', CollectionType::class, [
                'entry_type' => AuthorType::class,
                'entry_options' => [
                    'attr' => ['class' => 'authors-box'],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false,
                'by_reference' => false,
                'label' => false,
            ])
            ->add('publisher', PublisherType::class, [
                'label' => 'Publisher information',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
