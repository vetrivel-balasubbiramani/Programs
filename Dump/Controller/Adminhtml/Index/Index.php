<?php
namespace Vendor1\Dump\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
         protected $resultPageFactory = false;  
         const ADMIN_RESOURCE='Vendor1_Dump::menu_item';
         

         public function __construct(
                 \Magento\Backend\App\Action\Context $context,
                 \Magento\Framework\View\Result\PageFactory $resultPageFactory
                 
         ) {
                 parent::__construct($context);
                 $this->resultPageFactory = $resultPageFactory;
         } 
         public function execute()
         {
                 $resultPage = $this->resultPageFactory->create();
                 $resultPage->getConfig()->getTitle()->prepend(__('Configuration Dump'));
                 return $resultPage;
         }
}