<?php

namespace App\Tests;

use App\Entity\Company;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{
    public function testSomething()
    {
        $company = new Company();

        $company->setName('x');
        $this->assertSame('x', $company->getName());
    }
}
