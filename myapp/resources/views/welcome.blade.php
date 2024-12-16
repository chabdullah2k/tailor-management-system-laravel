<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Auth</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons (Font Awesome for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMZd5x3LKjl7KnMO5T+KE5B7czv5ftlX+WRX1j9" crossorigin="anonymous" />
    <link href='https://fonts.googleapis.com/css?family=Noto Nastaliq Urdu' rel='stylesheet'>
    <style>
        body {
            font-family: Figtree, sans-serif;
            font-family: 'Noto Nastaliq Urdu';font-size: 18px;
             background: linear-gradient(135deg, #757c65, #aeb1ae);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-buttons {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 1rem;
        }

        .auth-button {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .dashboard{
            background-color: #2563eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);

        }
        .dashboard:hover {
            background-color: #1d4ed8;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .login {
            background-color: #2563eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login:hover {
            background-color: #1d4ed8;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .register {
            background-color: #10b981;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .register:hover {
            background-color: #059669;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        /* Container styling for the centered content */
        .container {
            max-width: 600px;
            padding: 2rem;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
    <div class="auth-buttons">
        @auth
            <a href="{{ url('/index') }}" class="auth-button dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ url('/mainorder') }}" class="auth-button dashboard">
                <i class="fas fa-tachometer-alt"></i>مین آرڈر
            </a>
        @else
            <a href="{{ route('login') }}" class="auth-button login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="auth-button register">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            @endif
        @endauth
    </div>
@endif


    <div class="container">
        <h1>درزی کی دکان میں خوش آمدید</h1>
        <p>اپنے اکاؤنٹ تک رسائی کے لیے براہ کرم لاگ ان یا رجسٹر ہوں۔</p>
    </div>
</body>
</html>
