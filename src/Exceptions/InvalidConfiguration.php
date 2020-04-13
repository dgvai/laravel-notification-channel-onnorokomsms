<?php 
namespace DGvai\OnnorokomSMS\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static('In order to send notification via OnnorokomSMS you need to add credentials in the `onnorokomsms` key of `config.services`.');
    }
}