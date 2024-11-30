<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('send') }}" method="POST">
    @csrf
    <label>From: <input type="email" name="from" value="{{ old('from') }}" required></label><br>
    <label>To: <input type="email" name="to" value="{{ old('to') }}" required></label><br>
    <label>CC: <input type="email" name="cc" value="{{ old('cc') }}"></label><br>
    <label>Subject: <input type="text" name="subject" value="{{ old('subject') }}" required></label><br>
    <label>Type:
        <select name="type" required>
            <option value="text" {{ old('type') == 'text' ? 'selected' : '' }}>Text</option>
            <option value="html" {{ old('type') == 'html' ? 'selected' : '' }}>HTML</option>
        </select>
    </label><br>
    <label>Body: <textarea name="body" required>{{ old('body') }}</textarea></label><br>
    <button type="submit">Send</button>
</form>
</body>
</html>
