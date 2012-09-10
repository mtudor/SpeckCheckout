<?php

namespace SpeckCheckout\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CheckoutController extends AbstractActionController
{
    protected $checkoutService;

    public function indexAction()
    {
        $entryPoint = $this->getCheckoutService()->getCheckoutEntryPoint();
        return $this->redirect()->toRoute($entryPoint['route']);
    }

    /**
     * @TODO REMOVE -- DEV ONLY
     */
    public function tempPopulateCartAction()
    {
        $cartsvc = $this->getServiceLocator()->get('SpeckCart\Service\CartService');

        $item = new \SpeckCart\Entity\CartItem(array(
            'description' => 'Widget',
            'price' => 0.99,
            'quantity' => 2,
            'added_time' => new \DateTime(),
            'tax' => 0.00
        ));

        $cartsvc->addItemToCart($item);
    }

    public function getCheckoutService()
    {
        if (!isset($this->checkoutService)) {
            $this->checkoutService = $this->getServiceLocator()->get('SpeckCheckout\Service\Checkout');
        }

        return $this->checkoutService;
    }

    public function setCheckoutService($service)
    {
        $this->checkoutService = $service;
    }
}
