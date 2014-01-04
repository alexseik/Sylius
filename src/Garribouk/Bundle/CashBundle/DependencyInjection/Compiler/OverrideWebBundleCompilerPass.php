<?php

namespace Garribouk\Bundle\CashBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideWebBundleCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        //Sobreescribir el menu del backend
        $definition = $container->getDefinition('sylius.menu_builder.backend');
        $definition->setClass('Garribouk\Bundle\CashBundle\Menu\BackendMenuBuilder');
    }
}
