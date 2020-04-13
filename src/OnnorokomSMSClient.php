<?php 
namespace DGvai\OnnorokomSMS;

use DGvai\OnnorokomSMS\Exceptions\CouldNotSendNotification;

class OnnorokomSMSClient
{
    /**
     * Credentials which is used for 
     * login in OnnorokomSMS
     */

    protected $username;
    protected $password;

    /**
     * SMS Type
     * 1. TEXT  =  For Text Message
     * 2. UCS   =  For Unicoded Text Message
     */

    protected $type;

    /**
     * Mask Name which is allowed to the client panel
     */

    protected $mask_name;

    /**
     * The campaign name for the service
     */

    protected $campaign_name;

    /**
     * The construction of client
     */

    public function __construct($username, $password, $type = 'Text', $mask_name = '', $campaign_name = '')
    {
        $this->username = $username;
        $this->password = $password;
        $this->type = $type;
        $this->mask_name = $mask_name;
        $this->campaign_name = $campaign_name;
    }

    /**
     * Send SMS Via API Call to OnnorokomSMS
     */

    public function sendSMS(string $mobile_number, string $message)
    {
        $soapClient = new \SoapClient("http://api2.onnorokomsms.com/sendsms.asmx?wsdl");
        $dataArray = [
            'userName'  => $this->username,
            'userPassword' => $this->password,
            'mobileNumber' => $mobile_number,
            'smsText' => $message,
            'type'  => $this->type,
            'maskName' => $this->mask_name,
            'campaignName'  => $this->campaign_name
        ];

        try 
        {
            $value = $soapClient->__call("OneToOne",[$dataArray]);
            $result = explode("||", $value->OneToOneResult);
            return $result; 
        } 
        catch(\SoapFault $ex) 
        {
            throw CouldNotSendNotification::soapClientError($ex->getMessage());
        }

    }

}