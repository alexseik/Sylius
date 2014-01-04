<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Garribouk\Bundle\CashBundle\DataFixtures\ORM;

use Sylius\Bundle\CoreBundle\DataFixtures\ORM\DataFixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of LoadCustomersData
 *
 * @author alejandro
 */
class LoadCustomersData extends DataFixture
{
    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {
        $repository = $this->get('cash.repository.customer');
        
        
        $customer = $repository->createNew();        
        $customer->setFirstName('Pedrito');
        $customer->setLastName('Rodriguez');
        $customer->setFiscalId('72772682S');
        $customer->setCurrency('EUR');
        $manager->persist($customer);
        
        
        $customer2 = $repository->createNew();        
        $customer2->setFirstName('Jaimito');
        $customer2->setLastName('Pérez');
        $customer2->setFiscalId('54896987S');
        $customer2->setCurrency('EUR');
        $manager->persist($customer2);
        
        
        $manager->flush();
        
    }


}
