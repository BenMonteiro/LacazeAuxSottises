<?php

namespace App\Form\DataTransformer;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class CompanyTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (company) to a string.
     *
     * @param  Company|null $company
     * @return string
     */
    public function transform($company)
    {
        if (null === $company) {
            return '';
        }

        return $company->getName();
    }

    /**
     * Transforms a string to an object (company).
     *
     * @param  string $company
     * @return Company|null
     * @throws TransformationFailedException if object (company) is not found.
     */
    public function reverseTransform($companyName)
    {
        // no company name? It's optional, so that's ok
        if (!$companyName) {
            return;
        }

        $company = $this->entityManager
            ->getRepository(Company::class)
            // query for the issue with this id
            ->findOneBy(['name' => $companyName]);

        if (null === $company) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A company with name "%s" does not exist!',
                $companyName
            ));
        }

        return $company;
    }
}
