<?php

namespace App\Form;

use App\Entity\Performance;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\CompanyTransformer;

class PerformanceType extends AbstractType
{
    private $transformer;
    protected $companyFieldType;
    protected $companyFieldOptions = [];

    public function __construct(CompanyTransformer $transformer)
    {
        $this->transformer = $transformer;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', $options['companyFieldType'], $options['companyFieldOptions'])
            ->add('cityShow')
            ->add('placeShow')
            ->add('date')
            ->add('price')
            ->add('isHighlight')
            ->add('event', $options['eventFieldType'], $options['eventFieldOptions']);

        if (preg_match('#admin/performance/new#', $options['url'])) {
            $builder->get('company')
                ->addModelTransformer($this->transformer);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performance::class,
            'translation_domain' => 'form',
            'companyFieldType' => null,
            'companyFieldOptions' => [],
            'url' => '',
            'eventFieldOptions' => [],
            'eventFieldType' => null
        ]);
    }
}
