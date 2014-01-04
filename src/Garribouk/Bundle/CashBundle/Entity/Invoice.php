<?php
namespace Garribouk\Bundle\CashBundle\Entity;


/**
 * Description of Invoice
 *
 * @author alejandro
 */

//TODO todo la clase invoice
class Invoice implements InvoiceInterface{

    protected $id;
    
    protected $user;
    
    protected $customer;
    
    protected $createdAt;
    
    protected $updatedAt;
    
    protected $deleteAt;
    
    protected $notes;
    
    protected $state;
    
    protected $amount;
    
    protected $number;
    
    
    public function addNote(NoteInterface $note) {
        
    }

    public function calculateAmount() {
        
    }

    public function getAmount() {
        
    }

    public function getCreatedAt() {
        
    }

    public function getCustomer() {
        
    }

    public function getNotes() {
        
    }

    public function getNumber() {
        
    }

    public function getState() {
        
    }

    public function getUpdatedAt() {
        
    }

    public function getWebUser() {
        
    }

    public function hasNote(NoteInterface $note) {
        
    }

    public function removeNote(NoteInterface $note) {
        
    }

    public function setCreatedAt(\DateTime $createdAt) {
        
    }

    public function setCustomer(CustomerInterface $customer) {
        
    }

    public function setNumber($numero) {
        
    }

    public function setState($state) {
        
    }

    public function setUpdatedAt(\DateTime $updatedAt) {
        
    }

    public function setWebUser($webuser) {
        
    }

    public function addBillingAddress(AddressInterface $billingAddress) {
        
    }

    public function hasBillingAddress(AddressInterface $billingAddress) {
        
    }

    public function removeBillingAddress(AddressInterface $billingAddress) {
        
    } 
}
