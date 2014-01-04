<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use Sylius\Bundle\OrderBundle\Model\OrderItem;

use \Sylius\Bundle\CoreBundle\Model\VariantInterface;

/**
 * Description of NoteItem
 *
 * @author alejandro
 */
class NoteItem extends OrderItem implements NoteItemInterface{
    
    protected $concepto;
    
    //TODO ¿Para qué quiero el producto en el itemticket?
    //protected $product;
    
    protected $variant;
   
    public function getConcepto() {
        return $this->concepto;
    }

//    public function getProduct() {
//        return $this->producto;
//    }

    public function getVariant() {
        return $this->variant;
    }

    public function setConcepto($concepto) {
        $this->concepto = $concepto;
    }

//    public function setProduct(\Sylius\Bundle\CoreBundle\Model\ProductInterface $product) {
//        $this->producto = $producto;
//    }

    public function setVariant(VariantInterface $variant) {
        $this->variant = $variant;
    }
}
