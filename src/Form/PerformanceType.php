<?php

namespace App\Form;

use App\Entity\Performance;
use App\Entity\Company;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function foo\func;

class PerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $performance = new Performance;
        $builder
            ->add('companyName', EntityType::class, [
                'class' => Company::class,
                'choice_attr' => function ($choice, $key, $value) {
                    if (isset($_GET['company_id']) && $value === $_GET['company_id']) {

                        return ['selected' => ''];
                    } else {

                        return [];
                    }
                }
            ])
            ->add('cityShow')
            ->add('placeShow')
            ->add('date')
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_attr' => function ($choice, $key, $value) {
                    if (isset($_GET['event_id']) && $value === $_GET['event_id']) {

                        return ['selected' => ''];
                    } else {

                        return [];
                    }
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performance::class,
            'translation_domain' => 'form'
        ]);
    }
}
