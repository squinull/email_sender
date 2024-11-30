<div>
    <p><strong>From:</strong> {{ $message->from }}</p>
    <p><strong>To:</strong> {{ $message->to }}</p>
    @if ($message->cc)
        <p><strong>CC:</strong> {{ $message->cc }}</p>
    @endif
    <p><strong>Type:</strong> {{ $message->type }}</p>
    <p><strong>IP Address:</strong> {{ $message->ip }}</p>
    <p><strong>User Agent:</strong> {{ $message->user_agent }}</p>
    <h3>Message Body:</h3>
    <iframe srcdoc="{{ $message->body }}" style="width: 100%; height: 300px; border: 1px solid #ccc;"></iframe>
</div>
