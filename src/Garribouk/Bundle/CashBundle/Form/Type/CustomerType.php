<?php
namespace Garribouk\Bundle\CashBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;

/**
 * Note form type.
 * 
 */
class CustomerType extends AbstractType
{
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Garribouk\Bundle\CashBundle\Entity\Customer',
            'cascade_validation' => true,
            'csrf_protection'   => false,
        ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('fiscalid', 'text')
            ->add('firstName', 'text')
            ->add('lastName', 'text')            
            ->add('notes', 'collection', array('type' => new NoteType()))
            ->add('addresses', 'collection', array('type' => new AddressType()))
        ;
    }
    

    public function getName() {
        return 'cash_customer';
    }
}
?>
