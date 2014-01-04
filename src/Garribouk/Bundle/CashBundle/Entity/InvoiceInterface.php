<?php
namespace Garribouk\Bundle\CashBundle\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author alejandro
 */
interface InvoiceInterface {
    public function getNumber();
    
    public function setNumber($numero);
    
    public function getCustomer();
    
    public function setCustomer(CustomerInterface $customer);
    
    public function getWebUser();
    
    public function setWebUser($webuser);
    
    public function getState();
    
    public function setState($state);
    
    public function calculateAmount();
    
    public function getAmount();
    
    public function getNotes();
    
    public function addNote(NoteInterface $note);
    
    public function removeNote(NoteInterface $note);
    
    public function hasNote(NoteInterface $note);
    
    public function addBillingAddress(AddressInterface $billingAddress);
    
    public function removeBillingAddress(AddressInterface $billingAddress);
    
    public function hasBillingAddress(AddressInterface $billingAddress);
}
