<?php
namespace Garribouk\Bundle\CashBundle\Entity;


use Sylius\Bundle\OrderBundle\Model\OrderInterface;
//use Sylius\Bundle\AddressingBundle\Model\AddressInterface;
use Garribouk\Bundle\CashBundle\Entity\CashInventoryUnitInterface;

/**
 *
 * @author alejandro
 */
interface NoteInterface extends OrderInterface {
    
    public function getCustomer();
    
    public function setCustomer(CustomerInterface $customer);
    
//    public function getBillingAddress();
//    
//    public function setBillingAddress($address);   
    
    public function getTaxTotal();
    
    public function getTaxAdjustments();
    
    public function removeTaxAdjustments();
    
    public function getInventoryUnits();
    
    public function addInventoryUnit(CashInventoryUnitInterface $inventoryUnit);
    
    public function removeInventoryUnit(CashInventoryUnitInterface $inventoryUnit);
    
    public function hasInventoryUnit(CashInventoryUnitInterface $inventoryUnit);
    
    public function getCurrency();
    
    public function setCurrency($currency);
    
    public function isBackOrdered();
    
//    public function setBackOrdered();
}
