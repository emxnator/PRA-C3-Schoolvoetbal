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
    <img src="{{ asset('/../../img/PaasToernooi.png') }}" alt="Logo" class="logo">
<nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('toernooien') }}">Toernooien</a>
    <a href="{{ route('tournaments.archiveIndex') }}">Archief</a>
    <a href="{{ route('teams') }}">Teams</a>
    <a href="{{ route('information') }}">Informatie</a>
    <a href="{{ route('contact') }}">Contact</a>
    
    @auth
        <div class="dropdown">
            <button class="dropbtn">{{ Auth::user()->name }} ▼</button>
            <div class="dropdown-content">
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin') }}">Admin Panel</a>
                @endif
                <a href="{{ route('profile.edit') }}">Profiel</a>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </a>
                </form>
            </div>
        </div>
    @else
        <div class="dropdown">
            <button class="dropbtn">Account ▼</button>
            <div class="dropdown-content">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            </div>
        </div>
    @endauth
</nav>
</header>
<main>
{{ $slot }}
</main>
<footer>
    <div class="footer-info">
        
        <nav class="footer-nav">
            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('toernooien') }}">Toernooien</a>
                <a href="{{ route('tournaments.archiveIndex') }}">Archief</a>
                <a href="{{ route('teams') }}">Teams</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>

            
            <div class="footer-contact">
                <p>Tel: +31 06000000</p>
                <p>Email: info@example.com</p>
            </div>
        </nav>

        

    </div>
</footer>
</body>
</html>