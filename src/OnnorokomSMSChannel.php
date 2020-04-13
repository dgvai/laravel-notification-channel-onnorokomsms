<?php 
namespace DGvai\OnnorokomSMS;

use DGvai\OnnorokomSMS\Exceptions\CouldNotSendNotification;
use DGvai\OnnorokomSMS\Exceptions\InvalidReceiver;
use DGvai\OnnorokomSMS\OnnorokomSMSClient;
use Illuminate\Notifications\Notification;

class OnnorokomSMSChannel 
{
    protected $onnorokomSmsClient;

    public function __construct(OnnorokomSMSClient $client)
    {
        $this->onnorokomSmsClient = $client;
    }

    public function send($notifiable, Notification $notification)
    {
        try 
        {
            $to = $this->getTo($notifiable);
            $message = $notification->toOnnorokomSMS($notifiable)->message();
            $result = $this->onnorokomSmsClient->sendSMS($to,$message);

            if($result[0] != '1900')
            {
                throw CouldNotSendNotification::serviceRespondedWithAnError($result[0].' - '.$result[1]);
            }
            else 
            {
                return true;
            }
        } 
        catch(\Exception $ex)
        {
            throw CouldNotSendNotification::unknownError($ex->getMessage());
        }
    }

    protected function getTo($notifiable)
    {
        if (isset($notifiable->mobile_number)) {
            return $notifiable->mobile_number;
        }
        
        if ($notifiable->routeNotificationFor('OnnorokomSMS')) {
            return $notifiable->routeNotificationFor('OnnorokomSMS');
        }

        throw InvalidReceiver::noReceiverSet();
    }
}