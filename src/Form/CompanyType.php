<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * This form include multiPerformanceForms
 */
class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('isHidden')
            ->add('description')
            ->add('showTitle')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => false,
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
            ])
            ->add('imageDescription')
            ->add('theme')
            ->add('duration')
            ->add('audience')
            ->add('isHosted')
            ->add('isHostedFrom', null, [
                'placeholder' => "-",
            ])
            ->add('isHostedUntil', null, [
                'placeholder' => "-",
            ])
            ->add('moreInfos')
            ->add('website')
            ->add('videoLink')
            ->add('performances', CollectionType::class, [
                'attr' => ['class' => 'perfs'],
                'entry_type' => PerformanceType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
            'translation_domain' => 'form'
        ]);
    }
}
