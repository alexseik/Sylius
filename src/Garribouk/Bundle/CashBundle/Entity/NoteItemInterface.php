<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use Sylius\Bundle\OrderBundle\Model\OrderItemInterface;

use Sylius\Bundle\CoreBundle\Model\VariantInterface;

/**
 *
 * @author alejandro
 */
interface NoteItemInterface extends OrderItemInterface{
    public function getConcepto();
    public function setConcepto($concepto);
//    public function getProduct();
//    public function setProduct(ProductInterface $product);
    public function getVariant();
    public function setVariant(VariantInterface $variant);    
}
