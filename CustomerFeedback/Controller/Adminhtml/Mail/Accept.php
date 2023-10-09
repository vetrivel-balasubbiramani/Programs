<?php


namespace Vendor1\CustomerFeedback\Controller\Adminhtml\Mail;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Vendor1\CustomerFeedback\Helper\Mail;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\Http;
use Vendor1\CustomerFeedback\Model\Feedback;
use Magento\Framework\Controller\Result\RedirectFactory;

class Accept extends Action
{
    /** @var PageFactory */
    private $pageFactory;
    protected $redirectFactory;

    protected $request;
    protected $_helperMail;
    protected $feedbackModel;

    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        Mail $helperMail,
        Http $request,
        RedirectFactory $redirectFactory,
        Feedback $feedbackModel
    ) {
        $this->pageFactory = $rawFactory;
        $this->_helperMail = $helperMail;
        $this->request = $request;
        $this->feedbackModel = $feedbackModel;
        $this->redirectFactory = $redirectFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $email = $this->request->getParam('email');
        $this->feedbackModel->markAsAccepted($email);

        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Feedback'));
        $this->_helperMail->sendEmail($email, 'email_accept_template');

        $resultRedirect = $this->redirectFactory->create();

        // Set the redirection URL (e.g., redirect to the homepage)
        $resultRedirect->setPath('customerfeedback/index/index/'); // You can specify any URL here

        // Add a success message (optional)
        $this->messageManager->addSuccessMessage(__('Mail Accepted.'));

        return $resultRedirect;
    }
}
