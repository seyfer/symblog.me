<?php

namespace Blogger\BlogBundle\Entity;

/**
 * Description of Enquiry
 *
 * @author seyfer
 */
class Enquiry
{

    protected $name;
    protected $email;
    protected $subject;
    protected $body;

    function getName()
    {
        return $this->name;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSubject()
    {
        return $this->subject;
    }

    function getBody()
    {
        return $this->body;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setSubject($subject)
    {
        $this->subject = $subject;
    }

    function setBody($body)
    {
        $this->body = $body;
    }

}
