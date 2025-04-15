<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #f3f4f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ccf2ff, #b3ecff, #99e5ff);
        }

        .login-container {
            background: white;
            padding: 30px;
            margin: auto;
            max-width: 400px;
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4338ca;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            font-size: 0.85em;
            margin-top: 5px;
        }

        .alert {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
            border: 1px solid #fca5a5;
            text-align: center;
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
        }

        button:hover {
            background: #00bfff;
        }

        a {
            display: block;
            text-align: right;
            margin-top: 10px;
            font-size: 0.9em;
            color: #4f46e5;
            text-decoration: none;
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
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email">
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
        <div class="alert" style="max-width: 400px; margin: 20px auto;">
            {{ $errors->first('email') }}
        </div>
    @endif
</body>
