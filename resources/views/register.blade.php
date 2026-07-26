<!DOCTYPE html>
<html>
<head>
    <title>AWS Cognito Registration</title>
</head>
<body>

<h2>Register User</h2>

<form action="/register" method="POST">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>

</form>

</body>
</html>