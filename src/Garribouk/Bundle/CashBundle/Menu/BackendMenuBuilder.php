<?php

/*
 * 
 */
namespace Garribouk\Bundle\CashBundle\Menu;

use Sylius\Bundle\WebBundle\Menu\BackendMenuBuilder as BaseMenu;

use Knp\Menu\ItemInterface;

/**
 *
 */
class BackendMenuBuilder extends BaseMenu
{


    /**
     * Add sales menu.
     *
     * @param ItemInterface $menu
     * @param array         $childOptions
     * @param string        $section
     */
    protected function addSalesMenu(ItemInterface $menu, array $childOptions, $section)
    {
        $child = $menu
            ->addChild('sales', $childOptions)
            ->setLabel($this->translate(sprintf('sylius.backend.menu.%s.sales', $section)))
        ;
        
        $child->addChild('cash', array(
            'route' => 'cash_page',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-inbox'),
        ))->setLabel($this->translate(sprintf('garribouk.backend.menu.%s.cash', $section)));

        $child->addChild('orders', array(
            'route' => 'sylius_backend_order_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-shopping-cart'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.orders', $section)));
        $child->addChild('new_order', array(
            'route' => 'sylius_backend_order_create',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-plus-sign'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.new_order', $section)));
        $child->addChild('payments', array(
            'route' => 'sylius_backend_payment_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-credit-card'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.payments', $section)));

        $child->addChild('promotions', array(
            'route' => 'sylius_backend_promotion_index',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-bullhorn'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.promotions', $section)));
        $child->addChild('new_promotion', array(
            'route' => 'sylius_backend_promotion_create',
            'labelAttributes' => array('icon' => 'glyphicon glyphicon-plus-sign'),
        ))->setLabel($this->translate(sprintf('sylius.backend.menu.%s.new_promotion', $section)));
    }


}
