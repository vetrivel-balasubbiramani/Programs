<?php
namespace Vendor1\MenuCreation\Controller\Adminhtml\Index;
class Index extends \Magento\Backend\App\Action
{
         protected $resultPageFactory = false;  
         

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
                //  $resultPage->setActiveMenu('Vendor1_MenuCreation::menu');
                 $resultPage->getConfig()->getTitle()->prepend(__('Vetri Items'));
                 return $resultPage;
         }
         protected function _isAllowed()
         {
                 return $this->_authorization->isAllowed('Vendor1_MenuCreation::index');
         }
}