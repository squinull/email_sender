<?php

namespace App\Repositories;

use App\Models\Message;

class MessageRepository
{
    public function create(array $data): Message
    {
        return Message::create($data);
    }

    public function findByUuid(string $uuid): ?Message
    {
        return Message::where('uuid', $uuid)->first();
    }
}
