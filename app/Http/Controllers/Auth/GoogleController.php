<?php
  
namespace App\Http\Controllers\Auth;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use \SocialiteProviders\Manager\Config;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        $clientId = "331329763166-k4088v8sdidlgbrj2akil89fthvme8rh.apps.googleusercontent.com";
        $clientSecret = "73auFb7OWC5FFALxd1PYPrl8";
        $redirectUrl = "http://localhost:8000/auth/google/callback";
        /*    $additionalProviderConfig = ['site' => 'meta.stackoverflow.com'];*/
        $config = new Config($clientId, $clientSecret, $redirectUrl/*, $additionalProviderConfig*/);
return Socialite::driver('google')->setConfig($config)->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();

            die($user->accessTokenResponseBody);
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('home');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}