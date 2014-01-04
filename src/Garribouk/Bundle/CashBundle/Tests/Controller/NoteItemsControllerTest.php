<?php
namespace Garribouk\Bundle\CashBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of NoteItemsControllerTest
 *
 * @author alejandro
 */
class NoteItemsControllerTest extends WebTestCase {
    
    public function testNew()
    {
        $client = static::createClient();

//        $crawler = $client->request('GET', '/administration/cash/api/notes');
        $crawler = $client->request('POST', '/cash/api/noteItems', array(), array(), array(
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
        ));
        
        $response = $client->getResponse();
        
        $this->assertJsonResponse($response, 200, true);
        $this->assertEquals(
            '{"children":{"title":[],"body":[]}}',
            $response->getContent(),
            $response->getContent());
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
