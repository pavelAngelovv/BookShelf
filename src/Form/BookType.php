<?php

namespace App\Form;

use App\Entity\Book;
use App\Enum\AvailableGenres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('releaseDate')
            ->add('genres', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => array_flip([
                    AvailableGenres::MYSTERY->value,
                    AvailableGenres::FICTION->value,
                    AvailableGenres::SCIFI->value,
                    AvailableGenres::THRILLER->value,
                    AvailableGenres::ADVENTURE->value,
                ]),
            ])
            ->add('author', AuthorType::class)
            ->add('publisher', PublisherType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
