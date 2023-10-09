<?php
namespace Vendor1\CustomerFeedback\Model\ResourceModel\Feedback;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'feedback_id';
	protected $_eventPrefix = 'feedback_table';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Vendor1\CustomerFeedback\Model\Feedback', 'Vendor1\CustomerFeedback\Model\ResourceModel\Feedback');
	}

}