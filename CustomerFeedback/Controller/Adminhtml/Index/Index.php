<?php

namespace Vendor1\CustomerFeedback\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface 
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param PageFactory $resultPageFactory
     */
    public function __construct(PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Prints the information 
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Customer feedback')));

        return $resultPage;
    }
}