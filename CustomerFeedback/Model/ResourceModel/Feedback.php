<?php

namespace Vendor1\CustomerFeedback\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Feedback extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('feedback_table', 'feedback_id');
    }
}