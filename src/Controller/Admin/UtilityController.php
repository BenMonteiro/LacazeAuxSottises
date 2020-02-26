<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CompanyRepository;

class UtilityController extends AdminController
{
    /** 
     * @Route("/admin/utility/companies", name="utility_companies", methods="GET")
     */
    public function getCompaniesApi(CompanyRepository $companyRepository, Request $request)
    {
        $companies = $companyRepository->findAllMatching($request->query->get('query'));
        return $this->json(['companies' => $companies], 200, [], ['groups' => ['autocomplete']]);
    }
}
