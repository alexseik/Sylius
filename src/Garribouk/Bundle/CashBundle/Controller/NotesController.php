<?php
namespace Garribouk\Bundle\CashBundle\Controller;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Garribouk\Bundle\CashBundle\Entity\Note;
use Garribouk\Bundle\CashBundle\Form\Type\NoteType;
use Garribouk\Bundle\CashBundle\Entity\Customer;

/**
 * Description of NotesController
 *
 * @author alejandro
 */
class NotesController extends FOSRestController{
    
    /**
     * @Rest\View
     */
    public function allAction(){
        
        $notes = $this->get('cash.repository.note')->findAll();
        
        

        return array('notes' => $notes);    
    }
    
    
    /**
     * Devuelve sólo un note por id.
     * 
     * @Rest\View
     */
    public function getAcion($id){
        
        $notes = $this->get('cash.repository.note')->findById($id);
        
        if (!$notes instanceof Note) {
            throw new NotFoundHttpException('Note not found');
        }
        
        return array('notes' => $notes);
    }

    public function editAction (Note $note){
        if (null === $note = $this->get('cash.repository.note')->findById($id)) {
            $note = new Note();
            $note->setId($id);
        }

        return $this->processForm($note);
    }

    public function newAction(){
        return $this->processForm(new Note());
    }
    
    
    
    private function processForm(Note $note){
        
        //mira si existe
        $statusCode = $this->get('cash.repository.note')->find($note->getId()) == null ? 201 : 204;
//        $noteType = $this->get('cash.form.type.note');
//        $noteType = $this->get('cash.form.type.customer');
//        $noteType = $this->container->getParameter('cash.form.type.note.class');

        $form = $this->createForm(new NoteType(), $note);
        $form->bind($this->getRequest());
        if ($form->isValid()) {
            $this->save($note);
            $response = new Response();
            $response->setStatusCode($statusCode);
            // set the `Location` header only when creating new resources
            if (201 === $statusCode) {
                $response->headers->set('Location',
                    $this->generateUrl('cash_notes_get', array('id' => $note->getId()),true)
                );
            }
            return $response;
        }

        return View::create($form, 400); 
    }
    
    public function removeAction(Note $note)
    {
        $this->remove($note);
    }
    
    public function getItemsAction(Note $note){
        return array('items' => $note->getItems());
    }
    
    public function patchAction(Note $note, Request $request)
    {
        $parameters = array();
        foreach ($request->request->all() as $k => $v) {
            // whitelist
            if (in_array($k, array('customer'))) {
                $parameters[$k] = $v;
            }
            
            if (in_array($k, array('items'))) {
                $parameters[$k] = $v;
            }
            
            if (in_array($k, array('itemsTotal'))) {
                $parameters[$k] = $v;
            }
            
            if (in_array($k, array('currency'))) {
                $parameters[$k] = $v;
            }
            
            if (in_array($k, array('number'))) {
                $parameters[$k] = $v;
            }
        }

        if (0 === count($parameters)) {
            return View::create(
                array('errors' => array('Invalid parameters.')), 400
            );
        }

        $note = $this->createNoteFromArray($parameters);
        
        $errors = $this->get('validator')->validate($note);

        if (0 < count($errors)) {
            return View::create(array('errors' => $errors), 400);
        }
        
        $this->save($note);

        $response = new Response();
        $response->setStatusCode(204);
        $response->headers->set('Location',
            $this->generateUrl(
                'cash_note_get', array('id' => $note->getId()),
                true // absolute
            )
        );

        return $response;
    }
    
    
    // PRIVATE METHODS : controlar los recursos
    
    private function createNoteFromArray(array $data){
        //TODO mejorar validation
        $note = new Note();
//        foreach ($data as $key => $value) {
//            
//        }
        if (isset($data['customer'])){
            $note->setCustomer($this->get('cash.manager.customer')->getReference('Entity\Customer', $data['customer']));
        }
        
        //TODO persistir los items....
        if (isset ($data['items'])){
            
            $note->setItems($items);
        }
        
        
        //total de items
        if (isset ($data['itemsTotal'])){
            $note->setItemsTotal($data['itemsTotal']);
        }
        
        
        //numero de ticket
        if(isset ($data['number'])){
            $note->setNumber($data['number']);
        }
//        $note->setConfirmed($confirmed);
        if (isset ($data['currency'])) {
            $note->setCurrency($data['currency']);
        }
    }
    
    
    private function save(Note $note){
        $this->get('cash.manager.customer')->persist($note);
    }
    
    private function remove(Note $note){
        $this->get('cash.manager.customer')->remove($note);
    }
}
