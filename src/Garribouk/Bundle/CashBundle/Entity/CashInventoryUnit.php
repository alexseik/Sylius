<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use Sylius\Bundle\InventoryBundle\Model\InventoryUnit;

use Garribouk\Bundle\CashBundle\Entity\CashInventoryUnitInterface;

class CashInventoryUnit extends InventoryUnit implements CashInventoryUnitInterface {
    
    protected $note;
    
    /**
     * @return null|OrderInterface
     */
    public function getNote(){
        return $this->note;
    }

    /**
     * @param null|OrderInterface $order
     */
    public function setNote(NoteInterface $note = null){
        $this->note = $note;
    }
    
}
?>
