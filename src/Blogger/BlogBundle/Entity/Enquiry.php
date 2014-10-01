<?php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());

        $metadata->addPropertyConstraint('email', new Email());

        $metadata->addPropertyConstraint('subject', new NotBlank());
        $metadata->addPropertyConstraint('subject', new Length(array(
            'min'        => 2,
            'max'        => 50,
            'minMessage' => 'Data must be at least {{ limit }} characters length',
            'maxMessage' => 'Data cannot be longer than {{ limit }} characters length',
        )));

        $metadata->addPropertyConstraint('body', new Length(array(
            'min'        => 2,
            'max'        => 50,
            'minMessage' => 'Data must be at least {{ limit }} characters length',
            'maxMessage' => 'Data cannot be longer than {{ limit }} characters length',
        )));
    }

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
