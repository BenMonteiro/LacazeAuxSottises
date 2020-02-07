<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('showTitle')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Image de la compagnie',
                'allow_delete' => true,
                'download_label' => true,
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
            ])
            ->add('theme')
            ->add('duration')
            ->add('audience')
            ->add('isInResidence')
            ->add('inResidenceFrom')
            ->add('inResidenceUntil')
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
