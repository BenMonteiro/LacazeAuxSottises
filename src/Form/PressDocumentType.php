<?php

namespace App\Form;

use App\Entity\PressDocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PressDocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fileType', ChoiceType::class, [
                'choices' => array(
                    'press.image' => 'image',
                    'press.file' => 'file',
                ),
                'choice_translation_domain' => 'press'
            ])
            ->add('documentFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => false,
                'download_uri' => false,
                'asset_helper' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PressDocument::class,
            'translation_domain' => 'form'
        ]);
    }
}
