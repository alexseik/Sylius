<?php

namespace Garribouk\Bundle\CashBundle\Form\Type;

use Sylius\Bundle\OrderBundle\Form\Type\OrderItemType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoteItemType extends OrderItemType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder->add('concepto');
        $builder->add('variant', new VariantType());
        $builder->add('discount','number');
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        //TODO : Comprobar que esta funcion no se carga el resolver de OrderItemType
        $resolver->setDefaults(array(
            'data_class' => 'Garribouk\Bundle\CashBundle\Entity\NoteItem',
        ));
    }

    public function getName()
    {
        return 'cash_noteItem';
    }
}

