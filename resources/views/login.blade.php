<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 90px;
            background: linear-gradient(to right, #ccf2ff, #b3ecff, #99e5ff);
        }

        .login-container {
            background: #ffff;
            padding: 40px;
            margin: auto;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #4338ca;
        }

        label{
            display: block; 
            margin-bottom: 3px; 
            font-size: 13px;
        }

        input{
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 13px;
        }

        .error-message {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #fca5a5;
            text-align: center;
            max-width: 400px;
            margin: 20px auto
        }

        .success-message{
            background-color: #d4edda; 
            color: #155724; 
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #155724;
            text-align: center;
            max-width: 400px;
            margin: 20px auto
        }

        button {
            background: #33ccff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background: #00bfff;
        }

        .forgot-link {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
        }

        .forgot-link a {
            color: #4338ca;
            text-decoration: none;
        }

        .forgot-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
            </div>

            <div>
                <button type="submit">Login</button>
            </div>

        </form>

    </div>

    @if ($errors->has('email'))
        <div class="error-message">
            {{ $errors->first('email') }}
        </div>
    @endif

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif
</body>
