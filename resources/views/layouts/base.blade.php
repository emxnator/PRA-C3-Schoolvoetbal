<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Homepagina</title>
    
<link href="{{ asset('../css/app.css') }}" rel="stylesheet">
</head>
<body>
<header>
<nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('toernooien') }}">Toernooien</a>
    <a href="{{ route('teams') }}">Teams</a>
    <a href="{{ route('contact') }}">Contact</a>
    
    <div class="dropdown">
        <button class="dropbtn">Account ▼</button>
        <div class="dropdown-content">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('signup') }}">Sign Up</a>
            <a href="{{ route('admin') }}">Admin Panel</a>
        </div>
    </div>
</nav>
</header>
<main>
{{ $slot }}
</main>
<footer>

</footer>
</body>
</html>