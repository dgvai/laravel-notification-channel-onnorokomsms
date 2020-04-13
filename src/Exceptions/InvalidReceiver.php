<?php 
namespace DGvai\OnnorokomSMS\Exceptions;

class InvalidReceiver extends \Exception 
{
    public static function noReceiverSet()
    {
        return new static('The notifiable did not have a receiving mobile number. Add a routeNotificationForOnnorokomSMS() method or a mobile_number attribute to your notifiable.');
    }
}