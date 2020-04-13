<?php 
namespace DGvai\OnnorokomSMS;

use Illuminate\Support\ServiceProvider;
use DGvai\OnnorokomSMS\OnnorokomSMSClient;
use DGvai\OnnorokomSMS\Exceptions\InvalidConfiguration;

class OnnorokomSMSServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(OnnorokomSMSChannel::class)
            ->needs(OnnorokomSMSClient::class)
            ->give(function(){
                $onnosmsConfig = config('services.onnorokomsms');
                if (is_null($onnosmsConfig)) {
                    throw InvalidConfiguration::configurationNotSet();
                }

                return new OnnorokomSMSClient(
                    $onnosmsConfig['username'],
                    $onnosmsConfig['password'],
                    $onnosmsConfig['type'],
                    $onnosmsConfig['mask_name'],
                    $onnosmsConfig['campaign_name']
                );
            });
    }
}