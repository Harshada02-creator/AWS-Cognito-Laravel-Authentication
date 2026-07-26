<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AWS Cognito</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#4f46e5,#2563eb,#06b6d4);
            overflow:hidden;
        }

        body::before{
            content:'';
            position:absolute;
            width:450px;
            height:450px;
            background:#fff;
            opacity:.08;
            border-radius:50%;
            top:-150px;
            left:-150px;
        }

        body::after{
            content:'';
            position:absolute;
            width:400px;
            height:400px;
            background:#fff;
            opacity:.06;
            border-radius:50%;
            bottom:-150px;
            right:-150px;
        }

        .card{
            width:420px;
            background:rgba(255,255,255,.15);
            backdrop-filter:blur(18px);
            padding:40px;
            border-radius:25px;
            box-shadow:0 20px 50px rgba(0,0,0,.25);
            color:white;
            z-index:2;
        }

        h1{
            text-align:center;
            margin-bottom:8px;
            font-size:34px;
        }

        p{
            text-align:center;
            opacity:.9;
            margin-bottom:30px;
        }

        .input-group{
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }

        input{
            width:100%;
            padding:14px;
            border:none;
            outline:none;
            border-radius:12px;
            font-size:15px;
        }

        .password-box{
            position:relative;
        }

        .password-box span{
            position:absolute;
            right:15px;
            top:50%;
            transform:translateY(-50%);
            cursor:pointer;
            color:#555;
            user-select:none;
        }

        button{
            width:100%;
            padding:15px;
            border:none;
            border-radius:12px;
            background:white;
            color:#2563eb;
            font-size:17px;
            font-weight:bold;
            cursor:pointer;
            transition:.3s;
        }

        button:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(0,0,0,.25);
        }

        .error{
            margin-top:20px;
            color:#ffd4d4;
            text-align:center;
            font-weight:bold;
        }

        .success{
            margin-top:20px;
            color:#7CFF7C;
            text-align:center;
            font-weight:bold;
        }

        .footer{
            margin-top:28px;
            text-align:center;
        }

        .footer a{
            color:white;
            font-weight:bold;
            text-decoration:none;
        }

    </style>
</head>
<body>

<div class="card">

    <h1>Welcome Back 👋</h1>
    <p>Login to your Cognito account</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">

        @csrf

        <div class="input-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                required>

        </div>

        <div class="input-group">

            <label>Password</label>

            <div class="password-box">

                <input
                    type="password"
                    id="password"
                    name="password"
                    required>

                <span onclick="togglePassword()">👁</span>

            </div>

        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <div class="footer">
        Don't have an account?
        <a href="/register">Register</a>
    </div>

</div>

<script>

function togglePassword(){

    let p=document.getElementById("password");

    if(p.type==="password")
        p.type="text";
    else
        p.type="password";

}

</script>

</body>
</html>