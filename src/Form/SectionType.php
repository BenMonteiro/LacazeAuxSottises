<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\FrontPage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('belongToPage', EntityType::class, [
                'class' => FrontPage::class,
                'choice_label' => 'name',
                'group_by' => 'tab',
                'choice_attr' => function ($choice, $key, $value) {
                    if (isset($_GET['page_id']) && $value === $_GET['page_id']) {

                        return ['selected' => ''];
                    } else {

                        return [];
                    }
                },
                'choice_translation_domain' => true
            ])
            ->add('title')
            ->add('subTitle')
            ->add('appearanceOrder')
            ->add('content')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'sectionImage',
                'allow_delete' => true,
                'download_label' => false,
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Section::class,
            'translation_domain' => 'form'
        ]);
    }
}
