<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Garribouk\Bundle\CashBundle\Tests\Fixtures;


use Garribouk\Bundle\CashBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of LoadCustomersData
 *
 * @author alejandro
 */
class LoadCustomersData {
    static public $customers = array();

    public function load(ObjectManager $manager)
    {
        $customer = new Customer();
        $customer->setFirstName('Jorge');
        $customer->setLastName('García');
        $customer->setFiscalId('72742682S');
        $customer->setCurrency('EUR');
        $manager->persist($customer);        
        $manager->flush();

        self::$customers[] = customer;
    }
}
