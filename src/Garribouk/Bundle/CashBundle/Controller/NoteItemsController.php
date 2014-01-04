<?php

namespace Garribouk\Bundle\CashBundle\Controller;

//use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Garribouk\Bundle\CashBundle\Entity\NoteItem;

use Garribouk\Bundle\CashBundle\Form\Type\NoteItemType;


use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations as Rest;

use FOS\RestBundle\Controller\Annotations\RouteResource;


class NoteItemsController extends FOSRestController
{
     /**
     * @Rest\View
     */
    public function allAction(){
        
        $noteItem = $this->get('cash.repository.noteItem')->findAll();

        return array('noteItem' => $noteItem);    
    }
    
    /**
     * 
     * 
     * @Rest\View
     */
    public function getAcion($id){
        
        $noteItem = $this->get('cash.repository.noteItemItem')->findById($id);
        
        if (!$noteItem instanceof NoteItem) {
            throw new NotFoundHttpException('NoteItem not found');
        }
        
        return array('noteItem' => $noteItem);
    }

    public function newAction(){
        return $this->processForm(new NoteItem());
    }
    

    public function editAction (Note $note){
        if (null === $note = $this->get('cash.repository.noteItem')->findById($id)) {
            $note = new Note();
            $note->setId($id);
        }

        return $this->processForm($note);
    }
    
    private function processForm(NoteItem $noteItem){
        
        //mira si existe
        $statusCode = $this->get('cash.repository.noteItem')->find($noteItem->getId()) == null ? 201 : 204;

        $form = $this->createForm('cash_noteItem', $noteItem);
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $noteItem->save();

            $response = new Response();
            $response->setStatusCode($statusCode);

            // set the `Location` header only when creating new resources
            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl(
                        'cash_noteItems_get', array('id' => $noteItem->getId()),
                        true // absolute
                    )
                );
            }

            return $response;
        }

        return View::create($form, 400); 
    }

}


