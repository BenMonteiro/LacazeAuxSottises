<?php

namespace App\Form;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('pageSlug', ChoiceType::class, [
                'choices' => [
                    'page.association.label' => [
                        'page.presentation' => 'association-index',
                        'page.association.projects' => 'association-projets-pluriels',
                        'page.association.coop' => 'association-coop-territoriale',
                        'page.association.team' => 'association-equipe',
                        'page.association.subscription' => 'association-adhésion'
                    ],
                    'page.season.label' => [
                        'page.prog' => 'saison-programmation',
                        'page.inDiffusion' => 'saison-cies-en-diffusion',
                        'page.season.inCreation' => 'saison-cies-en-creation',
                        'page.culturalActions' => 'saison-actions-culturelles'
                    ],
                    'page.fest.label' => [
                        'page.presentation' => 'festival-index',
                        'page.prog' => 'festival-programmation',
                        'page.fest.tickets' => 'festival-billeterie',
                        'page.inDiffusion' => 'festival-cies-en-diffusion',
                        'page.fest.proMeeting' => 'festival-rencontres-pro',
                        'page.culturalActions' => 'festival-actions-culturelles',
                        'page.fest.funSpace' => 'festival-espace-ludique',
                        'page.fest.plus' => 'festival-infos-complémentaires'
                    ],
                    'page.place.label' => [
                        'page.presentation' => 'tiers-lieu-index',
                        'page.place.ecoPlace' => 'tiers-lieu-eco-lieu',
                        'page.place.sharedSpaces' => 'tiers-lieu-espaces-partages'
                    ],
                    'page.activities.label' => [
                        'page.activities.livingShows' => 'activites-du-lieu-spectacles-vivants',
                        'page.activities.sust_dev' => 'activites-du-lieu-developpement-durable',
                    ],
                    'page.rentals' => 'locations',
                    'page.volunteering.label' => [
                        'page.volunteering.onYear' => 'benevolat-annuel',
                        'page.volunteering.onFest' => 'benevolat-durant-le-festival'
                    ],
                    'page.partners' => 'partenaires',
                    'page.support' => 'nous-soutenir',
                    'page.contact' => 'contact'
                ]
            ])
            ->add('title')
            ->add('subTitle')
            ->add('appearanceOrder')
            ->add('content')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'label' => 'Image associée au paragraphe',
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
            'data_class' => Section::class,
            'translation_domain' => 'form'
        ]);
    }
}
