<?php

namespace Vendor1\CustomerFeedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Vendor1\CustomerFeedback\Model\FeedbackFactory;
use Magento\Framework\App\Request\Http; // Import this class

class Submit extends Action
{
    protected $feedbackFactory;
    protected $request;

    public function __construct(
        Context $context,
        FeedbackFactory $feedbackFactory,
        Http $request // Inject the request object
    ) {
        parent::__construct($context);
        $this->feedbackFactory = $feedbackFactory;
        $this->request = $request;
    }

    public function execute()
    {
        $data = $this->request->getPostValue();

        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }

        try {
            $feedback = $this->feedbackFactory->create();
            $feedback->setData($data);
            $feedback->save();

            $this->messageManager->addSuccessMessage(__('Feedback submitted successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while submitting the feedback.'));
            $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
        }
        
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        
        // Set the URL for redirection
        $resultRedirect->setPath('/');
        return $resultRedirect;
    }
}
