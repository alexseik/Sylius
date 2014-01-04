<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use Sylius\Bundle\OrderBundle\Model\Order;

use Sylius\Bundle\OrderBundle\Model\AdjustmentInterface;

//use JMS\Serializer\Annotation as Serializer;

/**
 * Description of Note
 *
 * @author alejandro
 * 
 * 
 */

class Note extends Order implements NoteInterface{
    
//    protected $user;
    /**
     *
     * @var type Garribouk\Bundle\CashBundle\Model\Customer
     * 
     * 
     */
    protected $customer;
    
    /**
     * 
     *
     * @var type Sylius\Bundle\AddressingBundle\Model\Address
     */
//    protected $billingAddress;
    
    /**
     *
     * @var type Garribouk\Bundle\CashBundle\Model\CashInventoryUnitInterface
     */
    protected $inventoryUnits;
    
    
    /**
     *
     * @var type String
     */
    protected $currency;
    
    
   
    
//    // Recupera la direccion dada al ticket
//    //TODO Verificar que es opcional
//    public function getBillingAddress() {
//        return $this->billingAddress;
//    }
//    public function setBillingAddress($address) {
//        $this->billingAddress = $address;
//    }
    
    //EUR
    public function getCurrency() {
        return $this->currency;
    }
    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    
    
    public function getCustomer() {
        return $this->customer;
    }
    public function setCustomer(CustomerInterface $customer) {
        $this->customer = $customer;
    }
    
    //inserta una unidad de almacen
    public function addInventoryUnit(CashInventoryUnitInterface $unit) {
        if (!$this->inventoryUnits->contains($unit)) {
            $unit->setNote($this);
            $this->inventoryUnits->add($unit);
        }

        return $this;
    }
    
    public function getInventoryUnits() {
        return $this->inventoryUnits;
    }
    
    
    public function hasInventoryUnit(CashInventoryUnitInterface $inventoryUnit) {
        return $this->inventoryUnits->contains($unit);
    }

    public function removeInventoryUnit(CashInventoryUnitInterface $unit) {
        if ($this->inventoryUnits->contains($unit)) {
            $unit->setOrder(null);
            $this->inventoryUnits->removeElement($unit);
        }

        return $this;
    }
    
    // Los ajustes por impuestos
    public function getTaxAdjustments() {
        return $this->adjustments->filter(function (AdjustmentInterface $adjustment) {
            return Order::TAX_ADJUSTMENT === $adjustment->getLabel();
        });
    }

    public function getTaxTotal() {
        $taxTotal = 0;

        foreach ($this->getTaxAdjustments() as $adjustment) {
            $taxTotal += $adjustment->getAmount();
        }

        return $taxTotal;        
    }
    
    public function removeTaxAdjustments() {
        foreach ($this->getTaxAdjustments() as $adjustment) {
            $this->removeAdjustment($adjustment);
        }

        return $this;
    }
    
    public function isBackOrdered() {
        return true;
    }

}
