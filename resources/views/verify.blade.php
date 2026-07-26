<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>

<h2>Verify Your Email</h2>

<form action="/verify" method="POST">
    @csrf

    <input type="hidden" name="email" value="{{ $email }}">

    <label>Enter OTP</label><br><br>

    <input
        type="text"
        name="otp"
        placeholder="Enter verification code"
        required
    >

    <br><br>

    <button type="submit">
        Verify
    </button>

</form>

</body>
</html>