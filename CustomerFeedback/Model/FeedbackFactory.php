<?php

namespace Vendor1\CustomerFeedback\Model;

use Magento\Framework\ObjectManagerInterface;

class FeedbackFactory
{
    protected $objectManager;
    protected $instanceName;

    public function __construct(ObjectManagerInterface $objectManager, $instanceName = Feedback::class)
    {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    public function create(array $data = [])
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}