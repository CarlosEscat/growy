<?php

namespace App\Providers;
use App\Page; 

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;

use Auth;
use App\User_message_conversation;
use App\User_message;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { 
		if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
			$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: ' . $location);
			exit;
		}
		
		URL::forceScheme('https');
		
		view()->composer('*', function($settings) {
           if(Auth::guard('user')->check()) {
				$user_id = Auth::guard('user')->user()->id;
				$not_read_messages_count = User_message_conversation::where('last_to_id',$user_id)->where('is_read',0)->count();
				$settings->with('not_read_messages_count', $not_read_messages_count);
		   }
		});
    }
}
