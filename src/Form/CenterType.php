<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Center;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('address', TextType::class)
            ->add('url', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'label'         => 'Catégorie',
                'choice_label'  => 'name',
                'query_builder' => function (CategoryRepository $repository) {
                    return $repository->createQueryBuilder('l')
                        ->orderBy('l.name', 'ASC');
                },
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Center::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
