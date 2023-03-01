<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', TextType::class)
            ->add('title', TextType::class)
            ->add('subtitle', TextType::class)
            ->add('author', TextType::class)
            ->add('published', DateType::class)
            ->add('publisher', TextType::class)
            ->add('pages', TextType::class)
            ->add('description', TextType::class)
            ->add('website', TextType::class)
            ->add('category', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Subir Libro'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
