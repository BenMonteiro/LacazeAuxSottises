<?php

namespace App\Form;

use App\Entity\Performance;
use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;
use App\Form\DataTransformer\CompanyTransformer;

class PerformanceType extends AbstractType
{
    private $transformer;
    private $router;
    protected $companyFieldType;
    protected $companyFieldOptions = [];

    public function __construct(CompanyTransformer $transformer, RouterInterface $router)
    {
        $this->transformer = $transformer;
        $this->router = $router;
    }



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $uri = $_SERVER["REQUEST_URI"];
        $url = trim(parse_url($uri, PHP_URL_PATH), "/");

        if (isset($_GET['company_id']) or $url == 'admin/company/new') {
            $this->companyFieldType = EntityType::class;
            $this->companyFieldOptions = [
                'class' => Company::class,
                // Thanks to this attribute, the field is rightly prefilled
                'choice_attr' => function ($choice, $key, $value) {
                    if (isset($_GET['company_id']) && $value === $_GET['company_id']) {

                        return ['selected' => ''];
                    } else {

                        return [];
                    }
                }
            ];
        } else {
            $this->companyFieldType = TextType::class;
            $this->companyFieldOptions = [
                'invalid_message' => 'That is not a valid company',
                'attr' => [
                    'class' => 'js-company-autocomplete',
                    'data-autocomplete-url' => $this->router->generate('utility_companies')
                ]
            ];
            $builder->get('company')
                ->addModelTransformer($this->transformer);
        }

        $builder
            ->add('company', $this->companyFieldType, $this->companyFieldOptions)
            ->add('cityShow')
            ->add('placeShow')
            ->add('date')
            ->add('price', MoneyType::class, [
                'required' => false
            ])
            ->add('isHighlight')
            ->add('event', EntityType::class, [
                'class' => Event::class,
                // Thanks to this attribute, the field is rightly prefilled
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
