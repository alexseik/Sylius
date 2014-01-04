<?php

namespace Garribouk\Bundle\CashBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Garribouk\Bundle\CashBundle\DependencyInjection\DoctrineTargetEntitiesResolver;
/**
 * Description of ResolveDoctrineTargetEntitiesPass
 *
 * @author alejandro
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface{
    private $interfaces;
    private $bundlePrefix;

    public function __construct($bundlePrefix, array $interfaces)
    {
        $this->bundlePrefix = $bundlePrefix;
        $this->interfaces = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (true) {
            $resolver = new DoctrineTargetEntitiesResolver();
            $resolver->resolve($container, $this->interfaces);
        }
    }

    private function getDriver(ContainerBuilder $container)
    {
        return $container->getParameter(sprintf('%s.driver', $this->bundlePrefix));
    }
}
