<?php

namespace App\Notifications;

use App\Mail\BareMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification
{
    use Queueable;

    // PasswordResetNotificationクラスに$tokenプロパティと$mailプロパティを定義
    public $token;
    public $mail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    //  文字列である引数$tokenと、BaraMailクラスのインスタンスである引数$mailを、それぞれ上記のプロパティに代入する
    public function __construct(string $token, BareMail $mail)
    {
        $this->token = $token;
        $this->mail = $mail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->mail

            // (送信元メールアドレス, メールの送信者名(省略可))を渡す
            ->from(config('mail.from.address'),config('mail.from.name'))
            // 送信先メールアドレスを渡す
            ->to($notifiable->email)
            // メールの件名を渡す
            ->subject('[jikoto-shi]パスワード再設定')
            // テキスト形式のメールを送る場合に使用する
            ->text('emails.password_reset')
            // テンプレートとなるBladeに渡す変数を、withメソッドに連想配列形式で渡す
            ->with([
                'url'=>route('password.reset',[
                    'token'=>$this->token,
                    'email'=>$notifiable->email,
                ]),
                'count'=>config(
                    'auth.passwords.'.
                    config('auth.defaults.passwords').
                    '.expire'
                ),
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
