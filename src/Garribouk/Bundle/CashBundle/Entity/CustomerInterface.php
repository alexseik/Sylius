<?php
namespace Garribouk\Bundle\CashBundle\Entity;


use \Sylius\Bundle\AddressingBundle\Model\AddressInterface;

/**
 *
 * @author alejandro
 */
interface CustomerInterface {
    
    public function getId();
    
    public function setId($id);
    
    public function getFirstName();
    
    public function setFirstName($name);
    
    public function getLastName();
    
    public function setLastName($lastname);
    
    public function getAddresses();
    
    public function addAddress(AddressInterface $address);
    
    public function removeAddress(AddressInterface $address);
    
    public function hasAddress(AddressInterface $address);   
    
    public function getFiscalId();
    
    public function setFiscalId($fiscalId);
    
    public function getNotes();
    
    public function addNote(NoteInterface $note);
    
    public function removeNote(NoteInterface $note);
    
    public function hasNote(NoteInterface $note);
    
    public function getCurrency();
    
    public function setCurrency($currency);
}
