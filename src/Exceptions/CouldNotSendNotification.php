<?php 
namespace DGvai\OnnorokomSMS\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('OnnorokomSMS responded with an error-code: `'.$response.'`');
    }

    public static function soapClientError($response)
    {
        return new static('OnnorokomSMS soap responded with an error code: `'.$response.'`');
    }

    public static function unknownError($response)
    {
        return new static('Unknown error occurred: `'.$response.'`');
    }
}