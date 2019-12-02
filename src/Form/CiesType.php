<?php

namespace App\Form;

use App\Entity\Cies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('theme')
            ->add('image')
            ->add('place')
            ->add('duration')
            ->add('audience')
            ->add('furtherInfos')
            ->add('description')
            ->add('webSite')
            ->add('videoLink')
            ->add('inCreation')
            ->add('inDiffusion')
            ->add('fest')
            ->add('season')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cies::class,
        ]);
    }
}
