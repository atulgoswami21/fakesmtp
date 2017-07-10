<?php

namespace Mediotype\Mailtrap\Model;

use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\MessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Transport extends \Zend_Mail_Transport_Smtp implements TransportInterface
{
    /**
     * Mailtrap SMTP hostname
     */
    const HOSTNAME = 'smtp.mailtrap.io';

    /**
     * @var \Magento\Framework\Mail\MessageInterface
     */
    protected $message;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Transport constructor.
     *
     * @param MessageInterface $message
     * @param ScopeConfigInterface $scope
     * @param null $parameters
     */
    public function __construct(MessageInterface $message, ScopeConfigInterface $scope, $parameters = null)
    {
        if (!$message instanceof \Zend_Mail) {
            throw new \InvalidArgumentException("The message should be an instance of \Zend_Mail");
        }

        /**
         * Message Object
         */
        $this->message = $message;

        /**
         * Scope Config
         */
        $this->scopeConfig = $scope;

        /**
         * Mailtrap config array
         */
        $config = [
            "auth" => "login",
            "tsl" => "tsl",
            "port" => "465",
            "username" => $this->scopeConfig->getValue("mediotype/mailtrap/username"),
            "password" => $this->scopeConfig->getValue("mediotype/mailtrap/password")
        ];

        /**
         * Call parent contstructor
         */
        parent::__construct(self::HOSTNAME, $config);
    }

    /**
     * Send message using the Zend_Mail class
     *
     * @return void
     * @throws \Magento\Framework\Exception\MailException
     */
    public function sendMessage()
    {
        try {
            parent::send($this->message);
        } catch (\Exception $e) {
            throw new MailException(__($e->getMessage()));
        }
    }
}