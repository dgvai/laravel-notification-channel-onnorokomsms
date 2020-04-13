<?php 
namespace DGvai\OnnorokomSMS;

/**
 *  Laravel Notification Channel for OnnorokomSMS (Bangladesh)
 *  Package Developped by:
 * 
 *  ** Jalal Uddin                  **
 *  ** www.github.com/dgvai         **
 *  ** www.linkedin.com/in/dgvai    **
 * 
 *  LICENSE MIT
 */

class OnnorokomSMS 
{
    /**
     *  The message body to be sent to the user
     */

    protected $message;

    /**
     * primary contruction
     */

    public function __construct(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * retrive message body
     */

    public function message()
    {
        return $this->message;
    }
}