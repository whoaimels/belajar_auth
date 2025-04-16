<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
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

        
        input {
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
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
            border: 1px solid #fca5a5;
            text-align: center;
            max-width: 400px; 
            margin: 20px auto;
        }

        ul{
            list-style: none;
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

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #4338ca;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registrasi</h2>

        <form action="{{ route('submit.registrasi') }}" method="POST">
        @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password">
            </div>

            <div class="form-group">
                <label for="nomorhp">Nomor Handphone</label>
                <input type="tel" id="nomorhp" name="nomorhp" value="{{ old('nomorhp') }}" required placeholder="Masukkan nomor telepon">
            </div>

            <div>
                <button type="submit">Registrasi</button>
            </div>

            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
    @if ($errors->has('email'))
        <div class="error-message">
            {{ $errors->first('email') }}
        </div>
    @elseif ($errors->has('password'))
        <div class="error-message">
            {{ $errors->first('password') }}
        </div>
    @endif
</body>
