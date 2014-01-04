<?php
namespace Garribouk\Bundle\CashBundle\Form\Type;

use Sylius\Bundle\OrderBundle\Form\Type\OrderType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
/**
 * Note form type.
 * 
 */
class NoteType extends OrderType
{

    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('customer',new CustomerType())
            ->add('currency')
//            ->add('inventoryUnits', 'integer')
        ;
        
//        $builder->addEventListener(FormEvents::PRE_BIND, function (DataEvent $event) use ($refreshStates)
//        {
//            $form = $event->getForm();
//            $data = $event->getData();
//
//            if(array_key_exists('_token', $data)) {
//                $refreshStates($form, $data['country']);
//            }
//        });
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Garribouk\Bundle\CashBundle\Entity\Note',
            'csrf_protection'   => false,
        ));
    }
    public function getName() {
        return 'cash_note';
    }
}
