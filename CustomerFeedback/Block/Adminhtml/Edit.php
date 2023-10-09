<?php

namespace Vendor1\CustomerFeedback\Block\Adminhtml;

use Vendor1\CustomerFeedback\Model\FeedbackFactory;
use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Framework\UrlInterface;

class Edit extends Template
{

 protected $_request;
 protected $_coreRegistry;
 protected $_modelDataFactory;
 protected $_buttonList;
 protected $_url;
 
 public function __construct(
 \Magento\Backend\Block\Widget\Context $context,
 \Magento\Framework\App\Request\Http $request,
 \Magento\Framework\Registry $registry,
 FeedbackFactory $DataFactory,
 UrlInterface $url,
 ButtonList $buttonList,
 array $data = []
 ) {
 $this->_coreRegistry = $registry;
 $this->_modelDataFactory = $DataFactory;
 $this->_request = $request;
 $this->_buttonList = $buttonList;
 $this->_url = $url;
 parent::__construct($context, $data);
 }

 public function getFeedback()
 {
 // return $this->request->getParam('id');
 return $this->_modelDataFactory->create()->load($this->_request->getParam('id'));
 }
 public function isAccepted()
 {
 $message = __('Are you sure you want to send an order email to customer?');

 $this->_buttonList->add(
 'is_accepted',
 [
 'label' => __('Accepted'),
 'on_click' => "confirmSetLocation('{$message}', '{$this->getEmailUrl()}')",
 'class' => 'primary',
 'id' => 'my_button'
 ]
 );
 return $this->_buttonList;
 }

 public function setAcceptUrl($email)
 {
 return $this->_url->getUrl(
 'customerfeedback/mail/accept'
 ).'email/'.$email;
 }

 public function setRejectUrl($email)
 {
 return $this->_url->getUrl(
 'customerfeedback/mail/reject'
 ).'email/'.$email;
 }
}