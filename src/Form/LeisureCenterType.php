<?php

namespace App\Form;

use App\Entity\LeisureCategory;
use App\Entity\LeisureCenter;
use App\Repository\LeisureCategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeisureCenterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('address', TextType::class)
            ->add('url', TextType::class)
            ->add('leisureCategory', EntityType::class, [
                'class' => LeisureCategory::class,
                'multiple' => true,
                'label'         => 'Catégorie',
                'choice_label'  => 'name',
                'query_builder' => function (LeisureCategoryRepository $repository) {
                    return $repository->createQueryBuilder('l')
                        ->orderBy('l.name', 'ASC');
                },
            ])
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LeisureCenter::class,
            // 'block_name' => null,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
