<!DOCTYPE html>
<html>
<head>
    <title>Reset hasła</title>
</head>
<body>
    <h2>Reset hasła</h2>
    <p>Otrzymałeś ten email, ponieważ złożono prośbę o reset hasła dla Twojego konta.</p>
    <p>Aby zresetować hasło, kliknij w poniższy link:</p>
    <a href="{{ url('reset-password', $token) }}">Reset hasła</a>
    <p>Link jest ważny przez 60 minut.</p>
    <p>Jeśli to nie Ty prosiłeś o reset hasła, zignoruj tę wiadomość.</p>
</body>
</html>