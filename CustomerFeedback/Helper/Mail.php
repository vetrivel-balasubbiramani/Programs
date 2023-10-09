<?php

namespace Vendor1\CustomerFeedback\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Escaper;

class Mail extends AbstractHelper
{
    protected $transportBuilder;
    protected $storeManager;
    protected $escaper;
    protected $inlineTranslation;

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        Escaper $escaper,
        StateInterface $state
    ) {
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        parent::__construct($context);
    }

    public function sendEmail($email, $templateId)
    {
        $this->inlineTranslation->suspend();
        $senderEmail = 'support@example.com';
        $senderName = 'Admin';
        $toEmail = $email;
        
        $templateVars = [
            'AcceptStatus' => 'accepted',
            'RejectStatus' => 'rejected'
        ];
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $storeId = $this->storeManager->getStore()->getId();
        $sender = ['email' => $senderEmail, 'name' => $senderName];
        

        $templateOptions = [
            'area' => \Magento\Framework\App\Area::AREA_ADMINHTML,
            'store' => $storeId
        ];
       
        $transport = $this->transportBuilder->setTemplateIdentifier(
            $templateId,
            $storeScope
        )
            
            ->setTemplateOptions($templateOptions)
            ->setTemplateVars($templateVars)
            ->setFrom($sender)
            ->addTo([$toEmail])
            ->getTransport();
        try {
            
            
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->_logger->error($e->getMessage());
        }
    }
}

