<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject("Reset Password Notification")
                ->greeting("HELLO")
                ->line("You are receiving this email because we received a password reset request for your account.")
                ->action("Reset Password", url(route("password.reset", [
                    "token" => $token,
                    "email" => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line(Lang::get("This password reset link will expire in :count minutes.", ["count" => config("auth.passwords.".config("auth.defaults.passwords").".expire")]))
                ->line("If you did not request a password reset, no further action is required.")
                ->salutation("Contact App Team.");
        });

        VerifyEmail::toMailUsing(function ($notifiable) {
            return (new MailMessage)
                ->subject("Verify Email Address")
                ->greeting("HELLO")
                ->line("Please click the button below to verify your email address.")
                ->action("Verify Email Address", URL::temporarySignedRoute(
                    "verification.verify",
                    Carbon::now()->addMinutes(Config::get("auth.verification.expire", 60)),
                    [
                        "id" => $notifiable->getKey(),
                        "hash" => sha1($notifiable->getEmailForVerification()),
                    ]
                ))
                ->line("If you did not create an account, no further action is required.")
                ->salutation("Contact App Team.");
        });
    }

    // Modify the remain part of text in `/resources/views/vendor/notifications/email.blade.php`
}
