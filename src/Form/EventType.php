<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('startingDate')
            ->add('endingDate')
            ->add('hours')
            ->add('programPDFFile', VichFileType::class, [
                'label' => 'Programme (format PDF)',
                'required' => false,
                'allow_delete' => true,
                'download_label' => true,
                'download_uri' => true,
                'asset_helper' => true,
            ])
            ->add('programImageFile', VichImageType::class, [
                'label' => 'Image du programme',
                'required' => false,
                'allow_delete' => true,
                'download_label' => true,
                'download_uri' => true,
                'image_uri' => true,
                'asset_helper' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
            'translation_domain' => 'form'
        ]);
    }
}
