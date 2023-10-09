<?php
namespace Vendor1\CustomerFeedback\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const FEEDBACK_ID = 'feedback_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const COMMENT = 'comment';


    /**
     * Get FeedbackId.
     *
     * @return int
     */
    public function getFeedbackId();

    /**
     * Set FeedbackId.
     */
    public function setFeedbackId($feedbackId);

    /**
     * Get FirstName.
     *
     * @return string
     */
    public function getFirstName();

    /**
     * Set FirstName.Email
     */
    public function setFirstName($firstName);   
    
    /**
     * Get LastName.
     *
     * @return string
     */
    public function getLastName();

    /**
     * Set LastName.
     */
    public function setLastName($lastName);

    /**
     * Get Email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set Email.
     */
    public function setEmail($email);

        /**
     * Get Comment.
     *
     * @return string
     */
    public function getComment();

    /**
     * Set Comment.
     */
    public function setComment($comment);


    
}

 
