<?php

namespace Garribouk\Bundle\CashBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

//use Garribouk\Bundle\CashBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Garribouk\Bundle\CashBundle\DependencyInjection\Compiler\OverrideWebBundleCompilerPass;
class GarriboukCashBundle extends Bundle
{

    
    public function build(ContainerBuilder $container){
//        Inclusión de los nuevos mappings doctrine
        //TODO investigar porqué tengo que incluir en config.yml las interface también
        $interfaces = array(
            'Garribouk\Bundle\CashBundle\Entity\NoteInterface'              => 'cash.model.note.class',
            'Garribouk\Bundle\CashBundle\Entity\NoteItemInterface'          => 'cash.model.note_item.class',
            'Garribouk\Bundle\CashBundle\Entity\CashInventoryUnitInterface' => 'cash.model.inventory_unit.class',
            'Garribouk\Bundle\CashBundle\Entity\CustomerInterface'          => 'cash.model.customer.class'
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('sylius_core', $interfaces));
        
        
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Garribouk\Bundle\CashBundle\Entity'
        );
        
        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('doctrine.orm.entity_manager'),false));
        $container->addCompilerPass(new OverrideWebBundleCompilerPass());
    }
}
