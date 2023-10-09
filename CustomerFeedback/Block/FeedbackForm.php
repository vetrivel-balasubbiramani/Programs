<?php

namespace Vendor1\CustomerFeedback\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session as CustomerSession;

class FeedbackForm extends Template
{
    protected $customerSession;

    public function __construct(Context $context, CustomerSession $customerSession, array $data = [])
    {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function getFormAction()
    {
        
        return $this->getUrl('/', ['_secure' => true]);
    }
}
