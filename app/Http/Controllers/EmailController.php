<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Http\Requests\SendEmailRequest;
use App\Services\EmailService;
use App\Repositories\MessageRepository;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    protected EmailService $emailService;
    protected MessageRepository $messageRepository;

    public function __construct(EmailService $emailService, MessageRepository $messageRepository)
    {
        $this->emailService = $emailService;
        $this->messageRepository = $messageRepository;
    }

    public function index()
    {
        return view('email.index');
    }

    public function send(SendEmailRequest $request)
    {
        $validated = $request->validated();

        $message = $this->messageRepository->create([
            'from' => $validated['from'],
            'to' => $validated['to'],
            'cc' => $validated['cc'] ?? null,
            'subject' => $validated['subject'],
            'type' => $validated['type'],
            'body' => $validated['body'],
            'uuid' => \Str::uuid(),
            'ip' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        SendEmailJob::dispatch($validated);

        return redirect()->route('success', ['uuid' => $message->uuid]);
    }

    public function success($uuid)
    {
        $message = $this->messageRepository->findByUuid($uuid);
        if (!$message) {
            abort(404, 'Message not found');
        }

        return view('email.success', compact('message'));
    }
}
