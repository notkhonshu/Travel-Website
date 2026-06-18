<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; margin: 0; padding: 32px 16px; }
        .wrap { max-width: 560px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; }
        .head { background: #1a4b3a; padding: 28px 32px; }
        .head h1 { color: #fff; font-size: 20px; margin: 0; }
        .body { padding: 32px; }
        .row { margin-bottom: 20px; }
        .row label { display: block; font-size: 11px; font-weight: 600; text-transform: uppercase;
                     letter-spacing: 0.1em; color: #888; margin-bottom: 4px; }
        .row p { margin: 0; font-size: 15px; color: #222; line-height: 1.6; }
        .msg { background: #f7f7f7; border-left: 3px solid #1a4b3a;
               border-radius: 4px; padding: 16px; margin-top: 4px; }
        .foot { padding: 20px 32px; border-top: 1px solid #eee; font-size: 12px; color: #aaa; }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="head">
            <h1>New Contact Form Submission</h1>
        </div>
        <div class="body">
            <div class="row">
                <label>Name</label>
                <p>{{ $data['name'] }}</p>
            </div>
            <div class="row">
                <label>Email</label>
                <p>{{ $data['email'] }}</p>
            </div>
            @if(!empty($data['phone']))
            <div class="row">
                <label>Phone</label>
                <p>{{ $data['phone'] }}</p>
            </div>
            @endif
            <div class="row">
                <label>Subject</label>
                <p>{{ $data['subject'] }}</p>
            </div>
            <div class="row">
                <label>Message</label>
                <div class="msg">
                    <p>{{ $data['message'] }}</p>
                </div>
            </div>
        </div>
        <div class="foot">
            Sent from {{ config('app.name') }} contact form &middot; {{ now()->format('d M Y, H:i') }}
        </div>
    </div>
</body>
</html>