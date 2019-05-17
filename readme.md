# Setup
1. Run command ```composer require hanhbt-1821/sauth```
2. Open _app/config.php_ and add to _providers_:
    ```php
    'providers' => [
        ...
        SocialiteProviders\Manager\ServiceProvider::class,
        SocialiteProviders\Generators\GeneratorsServiceProvider::class,
        ...
    ];
    ```

3. Open _app/Providers/EventServiceProvider.php_ and add to _$listen_
    ```php
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\SunAsterisk\\SunAsteriskExtendSocialite@handle',
        ],
    ];
    ```

4. Add to _.env_
    ```
    SUNASTERISK_CLIENT_ID=
    SUNASTERISK_CLIENT_SECRET=
    SUNASTERISK_REDIRECT_URL="${APP_URL}/sauth/callback"
    #SUNASTERISK_BASE_URL=
    ```
    Edit values for your app, include ```APP_URL```. ```SUNASTERISK_BASE_URL``` is optional variable, if it is not present, provider will use default value: ```https://edev.sun-asterisk.vn```

5. Add to _config/services.php_
    ```php
    'sunasterisk' => [
        'client_id' => env('SUNASTERISK_CLIENT_ID'),
        'client_secret' => env('SUNASTERISK_CLIENT_SECRET'),
        'redirect' => env('SUNASTERISK_REDIRECT_URL'),
    ],
    ```

6. Add to _routes/web.php_
    ```php
    Route::get('/sauth', 'Auth\LoginController@SAuthRedirect')->name('sauth');
    Route::get('/sauth/callback', 'Auth\LoginController@SAuthCallback')->name('sauth.callback');
    ```

7. In ```app/Http/Controller/Auth/LoginController.php```
    ```php
    use Socialite;

    ...

    public function SAuthRedirect()
    {
        return Socialite::driver('sunasterisk')->redirect();
    }

    public function SAuthCallback()
    {
        $user = Socialite::driver('sunasterisk')->user();

        return $user;
    }
    ```
