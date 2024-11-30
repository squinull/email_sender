<?php

namespace App\Jobs;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.example.com');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT', 587);

            $mail->setFrom($this->data['from']);
            $mail->addAddress($this->data['to']);
            if (!empty($this->data['cc'])) {
                $mail->addCC($this->data['cc']);
            }

            $mail->isHTML($this->data['type'] === 'html');
            $mail->Subject = $this->data['subject'];
            $mail->Body = $this->data['body'];

            $mail->send();
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка отправки письма: ' . $mail->ErrorInfo);
        }
    }
}
