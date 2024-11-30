<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    public function sendEmail(array $data)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST', 'smtp.example.com');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = env('MAIL_PORT', 587);

            $mail->setFrom($data['from']);
            $mail->addAddress($data['to']);
            if (!empty($data['cc'])) {
                $mail->addCC($data['cc']);
            }

            $mail->isHTML($data['type'] === 'html');
            $mail->Subject = $data['subject'];
            $mail->Body = $data['body'];

            $mail->send();
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка отправки письма: ' . $mail->ErrorInfo);
        }
    }
}
