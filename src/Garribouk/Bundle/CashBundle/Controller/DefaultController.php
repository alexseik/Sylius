<?php

namespace Garribouk\Bundle\CashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    public function pageAction(){
        return $this->render('GarriboukCashBundle:Default:page.html.twig', array());
    }
    
    public function searchVariantAction(){
        if ($this->getRequest()->isXmlHttpRequest()){
            $products = [];
            
            $repository = $this->container->get('sylius.repository.variant');
            
            if ($this->getRequest()->query->get('sku') != null){
                                
                $qb = $repository->createQueryBuilder('o')                                
                                 ->where('o.sku LIKE :sku')
                                 ->setParameter('sku', $this->getRequest()->query->get('sku').'%');
            } elseif ($this->getRequest()->query->get('name') != null){
//                $em = $this->container->get('doctrine.orm.entity_manager');
//                $query = $em->createQuery('SELECT DISTINCT v FROM Sylius\Bundle\CoreBundle\Model\Variant v JOIN v.product p  WHERE p.name LIKE ?1');
//                $query->setParameter(1, '%'.$this->getRequest()->query->get('name').'%');
//                $prods = $query->getResult();
                $qb = $repository->createQueryBuilder('o')
                                 ->innerJoin('o.product', 'p', 'WITH', 'p.id = o.product')
                                 ->where('p.name LIKE :name')
                                 ->setParameter('name', '%'.$this->getRequest()->query->get('name').'%');
            }
            
            

//            $products = $repository->findAll();
            if (isset($qb)){
                $products = $qb->getQuery()->getResult();
            }
            
            

            $array = [];

            foreach ($products as $product){
                    $array[] = array (
                        'id' => $product->getProduct()->getId(),
                        'sku' => $product->getSku(),
                        'name' => $product->getProduct()->getName(),
                        'price'=> $product->getPrice(),
                        'stock'=> $product->getOnHand()
                    );
            }

            //$format = $this->getRequest()->getRequestFormat();
            $format = "json";

            return $this->render('GarriboukCashBundle:Respuestas:product.'.$format.'.twig', array('data' => $array));
        }

        return $this->redirect($this->generateUrl('cash_page'));
    }
        
        
    public function searchCustomerAction(){
        
         if ($this->getRequest()->isXmlHttpRequest()){
            $customers = [];
            
            $repository = $this->container->get('cash.repository.customer');
            $qb = $repository->createQueryBuilder('o');

            if ($this->getRequest()->query->get('firstname') != null && $this->getRequest()->query->get('lastname') != null){                                
                
                $expr = $qb->expr()->orX(
                    $qb->expr()->like('o.firstName', ':firstname'),
                    $qb->expr()->like('u.lastName', ':lastname')
                );
                $qb->where($expr);
                $qb->setParameter('firstname', '%'.$this->getRequest()->query->get('firstname').'%');
                $qb->setParameter('lastname', '%'.$this->getRequest()->query->get('lastname').'%');
            }
            else if ($this->getRequest()->query->get('firstname') != null){
                $expr = $qb->expr()->like('o.firstName', ':firstname');
                $qb->where($expr);
                $qb->setParameter('firstname', '%'.$this->getRequest()->query->get('firstname').'%');
            }
            else if ($this->getRequest()->query->get('lastname') != null){
                $expr = $qb->expr()->like('o.lastName', ':lastname');
                $qb->where($expr);
                $qb->setParameter('lastname', '%'.$this->getRequest()->query->get('lastname').'%');
            }else{
                
            }
                
            
      
            

//            $products = $repository->findAll();
            if (isset($qb)){
                $customers = $qb->getQuery()->getResult();
            }
            
            

            $array = [];

            foreach ($customers as $customer){
                $array[] = array (
                    'firstname' => $customer->getFirstName(),
                    'lastname' => $customer->getLastName(),
                    'fiscalid' => $customer->getFiscalId()
                );
            }

            //$format = $this->getRequest()->getRequestFormat();
            $format = "json";

            return $this->render('GarriboukCashBundle:Respuestas:customer.'.$format.'.twig', array('data' => $array));
      }

      return $this->redirect($this->generateUrl('cash_page'));
   }

}
