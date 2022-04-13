<?php
namespace SendEmail;

/**
 * Send email with Hostgator.
 *
 * This class is used to configure and send email from Hostgator.
 *
 * @author Fernando Di Masi <wildiney@gmail.com>
 * @version 1.0
 *
 * HOW TO USE (example)
 * $email = new Hostgator;
 * $email->from('user@domain.com');
 * $email->to('user@domain.com');
 * $email->subject('Subject');
 * $email->message('Message');
 * $email->send();
 */
class Hostgator
{
    /**
     * From variable
     *
     * @access private
     * @var string
     */
    private $from;

    /**
     * To variable
     *
     * @access private
     * @var string
     */
    private $to;
    
    /**
     * Head variable
     *
     * @access private
     * @var string
     */
    private $head = null;
    
    /**
     * Subject variable
     *
     * @var string
     */
    private $subject;
    
    /**
     * Message variable
     *
     * @var string
     */
    private $message;

    /**
     * Set the field From.
     *
     * @param string $from
     * @return void
     */
    public function from($from)
    {
        $this->from = $from;
    }
    
    /**
     * Get the field From
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }
    
    /**
     * Set the field to.
     *
     * @param string $to
     * @return void
     */
    public function to($to)
    {
        $this->to = $to;
    }
    
    /**
     * Get the field to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }
    
    /**
     * Set the Subject
     *
     * @param string $subject
     * @return void
     */
    public function subject($subject)
    {
        $this->subject = $subject;
    }
    
    /**
     * Get the Subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Set the message
     *
     * @param string $message
     * @return void
     */
    public function message($message)
    {
        $this->message = $message;
    }
    
    /**
     * Get the Message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Set the mail header or use the default
     *
     * @param string $head
     * @return void
     */
    public function head($head=null)
    {
        if (is_null($head)) {
            $head  = "From: " . $this->getFrom() . "\r\n";
            $head .= "MIME-Version: 1.0\r\n";
            $head .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        }
        $this->head = $head;
    }

    public function bcc($email)
    {
        $head = $this->head();
        $head.= "Bcc: " . $email . "\r\n";
        $this->head = $head;
    }
    
    /**
     * Get the mail header
     *
     * @return string
     */
    public function getHead()
    {
        return $this->head;
    }
    
    /**
     * Send the configured email
     *
     * @return bool
     */
    public function send()
    {
        if (is_null($this->getHead())) {
            $this->head();
        }
        if (mail($this->getTo(), $this->getSubject(), $this->getMessage(), $this->getHead())) {
            return true;
        } else {
            return false;
        }
    }
}
