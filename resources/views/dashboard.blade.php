<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#4f46e5,#06b6d4);
        }

        .card{
            width:420px;
            background:white;
            padding:40px;
            border-radius:18px;
            text-align:center;
            box-shadow:0 15px 35px rgba(0,0,0,.2);
        }

        h1{
            color:#4f46e5;
            margin-bottom:15px;
        }

        p{
            color:#555;
            margin-bottom:25px;
        }

        .email{
            color:#111;
            font-weight:bold;
            margin-bottom:30px;
        }

        a{
            display:inline-block;
            padding:14px 30px;
            text-decoration:none;
            background:#ef4444;
            color:white;
            border-radius:10px;
            font-weight:bold;
        }

        a:hover{
            background:#dc2626;
        }
    </style>
</head>

<body>

<div class="card">

    <h1>🎉 Login Successful</h1>

    <p>Welcome to AWS Cognito Authentication</p>

    <div class="email">
        {{ session('email') }}
    </div>

    <a href="/logout">
        Logout
    </a>

</div>

</body>
</html>