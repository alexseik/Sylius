<?php
namespace Garribouk\Bundle\CashBundle\Entity;

use Sylius\Bundle\InventoryBundle\Model\InventoryUnitInterface as BaseInventoryUnitInterface;

interface CashInventoryUnitInterface extends BaseInventoryUnitInterface {
    
    /**
     * @return null|OrderInterface
     */
    public function getNote();

    /**
     * @param null|OrderInterface $order
     */
    public function setNote(NoteInterface $note = null);
    
}
?>
