<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use \Sylius\Bundle\AddressingBundle\Model\AddressInterface;

/**
 * Description of Customer
 *
 * @author alejandro
 */

use Garribouk\Bundle\CashBundle\Entity\CustomerInterface;

class Customer implements CustomerInterface{
    
    protected $id;
    
    protected $firstName;
    
    protected $lastName;
    
    protected $createdAt;
        
    protected $updatedAt;
       
    protected $currency;
    
    protected $notes;
    
    protected $addresses;
    
//    protected $invoices;
    
    protected $fiscalid;
    
//    protected $user;
    
    
    public function getCreatedAt() {
        $this->createdAt;
    }

    public function getUpdatedAt() {
        $this->updatedAt;        
    }

    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }

    public function addAddress(AddressInterface $address) {
        if (!$this->hasAddress($address)) {
            $this->addresses->add($address);
        }
        return $this;
    }

    public function getAddresses() {
        return $this->addresses;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function hasAddress(AddressInterface $address) {
        return $this->addresses->contains($address);
    }

    public function removeAddress(AddressInterface $address) {
        if ($this->hasAddress($address)) {
            $this->addresses->remove($address);
        }
        return $this;
    }

    public function setFirstName($name) {
        $this->firstName = $name;
    }

    public function setLastName($name) {
        $this->lastName = $name;
    }

    public function addNote(NoteInterface $note) {
        if (!$this->hasNote($note)) {
            $this->notes->add($note);
        }
        return $this;
    }

    public function getFiscalId() {
        return $this->fiscalid;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function hasNote(NoteInterface $note) {
        return $this->notes->contains($note);
    }

    public function removeNote(NoteInterface $note) {
        if ($this->hasNote($note)) {
            $this->notes->remove($note);
        }
        return $this;
    }

    public function setFiscalId($fiscalId) {
        $this->fiscalid = $fiscalId;
    }

    public function getId() {
        return $this->id;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function setId($id) {
        $this->id = $id;
    }

}
