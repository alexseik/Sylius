<?php
namespace Garribouk\Bundle\CashBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;

use Garribouk\Bundle\CashBundle\Entity\Note;
use Garribouk\Bundle\CashBundle\Entity\NoteItem;

use Sylius\Bundle\OrderBundle\Model\Adjustment;


/**
 * Description of NotesControllerTest
 *
 * @author alejandro
 */
class NotesControllerTest extends WebTestCase {
    
    public function testIndex()
    {
        $client = static::createClient();

//        $crawler = $client->request('GET', '/administration/cash/api/notes');
        $crawler = $client->request('GET', '/cash/api/notes', array(), array(), array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        $response = $client->getResponse();

        $this->assertJsonResponse($response, 200);
    }
    
    
    public function testGet(){
        

        $client = static::createClient();
        
        $crawler = $client->request('GET','/cash/api/notes',array('id'=> 1),array(),array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
        
        $response = $client->getResponse();       
        
        
        $this->assertJsonResponse($response, 200);
    }
    
    public function testNew(){
   //     $note = new Note();
      $client = static::createClient();
       
      $client->request(
            'POST',
            '/cash/api/notes',
            array(),
            array()
        );  

        $this->assertJsonResponse($client->getResponse(), 200, true);
        $this->assertEquals(
            '{"children":{"title":[],"body":[]}}',
            $client->getResponse()->getContent(),
            $client->getResponse()->getContent());
        
    }
    
    
    public function testEdit(){
//        $client = static::createClient();
//        
//        $crawler = $client->request('GET','/cash/api/notes',array('id'=> 1),array(),array('HTTP_X-Requested-With' => 'XMLHttpRequest'));
//        $response = $client->getResponse();
//        
//        
//        $note->setNumber('25122013A');
//        $fixtures = array('Garribouk\Bundle\CashBundle\Tests\Fixtures\LoadCustomersData');
//        $this->loadFixtures($fixtures);
//        $customers = LoadPageData::$customers;        
//        $customer = array_pop($customers);
//        $note->setCustomer($customer);
//        
//        $note->setCurrency('EUR');
//        
//        $noteItem = new NoteItem();
//        
//        $noteItem->setConcepto('tonto');
//        $noteItem->setOrder($note);
//        $results = $this->getContainer()->get('sylius.repository.variant')->findBySku('62162');
//        $variant = array_pop($results);
//        $noteItem->setVariant($variant);
//        $noteItem->setQuantity(1);
//        $noteItem->setUnitPrice($variant->getPrice());
//        $adjustment = new Adjustment();
//        $adjustment->setAdjustable($noteItem);
//        $adjustment->setAmount($variant->getPrice()*0.1);
//        $adjustment->setDescription('Descuento 10 %');
//        $adjustment->setLabel('Dto');        
//        $noteItem->addAdjustment($adjustment);
//        $items = array($noteItem);
//        $note->setItems($items);        
//        $note->setItemsTotal(1);
//        $note->setTotal($variant->getPrice() - $variant->getPrice()*0.1);
//        $client->request(
//                'PUT','/cash/api/notes',
//                array('id' => 1), //parameters
//                array(), //files
//                array('HTTP_X-Requested-With' => 'XMLHttpRequest'), //server
//                array());//content
//        $response = $client->getResponse();
//        $this->assertJsonResponse($response, 200);
//        $obj = json_decode($response,true);
//        
//        $this->assertEquals(count($obj['nodes']->items),0);
    }
    
    protected function assertJsonResponse($response, $statusCode = 200)
    {
        $this->assertEquals($statusCode, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
    }
}

