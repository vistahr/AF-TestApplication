<?php

namespace Frontend;

/**
 * Frontend\Customers
 */
class Customers
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get username
     *
     * @return string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @var integer $postcode
     */
    private $postcode;

    /**
     * Set postcode
     *
     * @param integer $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * Get postcode
     *
     * @return integer $postcode
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    /**
     * @var datetime $createdAt
     */
    private $createdAt;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var string $activation_code
     */
    private $activation_code;

    /**
     * Set mail
     *
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * Get mail
     *
     * @return string $mail
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set activation_code
     *
     * @param string $activationCode
     */
    public function setActivationCode($activationCode)
    {
        $this->activation_code = $activationCode;
    }

    /**
     * Get activation_code
     *
     * @return string $activationCode
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }
    /**
     * @var integer $status
     */
    private $status;

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer $status
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @var string $subject
     */
    private $subject;

    /**
     * Set subject
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * Get subject
     *
     * @return string $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
}