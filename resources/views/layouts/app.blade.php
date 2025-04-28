<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Carteira +Eficiente')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        body {
            padding-top: 56px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .footer {
            width: 100%;
            height: 60px;
            background-color: #f5f5f5;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40; /* Cor similar ao AdminLTE */
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff; /* Cor do texto branco */
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057; /* Cor de hover similar ao AdminLTE */
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .top-navbar {
            background-color: #343a40; /* Mesma cor da barra lateral */
            color: #ffffff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .top-navbar .navbar-brand {
            color: #ffffff;
        }
        .top-navbar .dropdown-menu {
            right: 0;
            left: auto;
        }
        .user-name {
            color: #ffffff;
            font-weight: bold;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info i {
            margin-right: 5px;
        }
    </style>
    @yield('styles')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg top-navbar">
        <a class="navbar-brand" href="/">Carteira +Eficiente</a>
        <div class="ml-auto">
            @auth
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle user-info" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 1.5rem; color: white;"></i>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Configurações da Conta</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light">Login</a>
            @endguest
        </div>
    </nav>

    @auth
        <div class="sidebar">
            <a class="navbar-brand" href="/">Carteira +Eficiente</a>
            <a href="{{route('preco-teto-basin.index')}}">Método Basin</a>
            <a href="{{route('preco-justo-graham')}}">Método Graham</a>
            @if(auth()->user()->id == '1') 
            <a href="{{route('stocks.index')}}">Stocks</a>
            @endif
            <a href="{{route('user.stocks.index')}}">Minhas Stocks</a>
            <a href="{{route('historicalData.index')}}">Histórico de preços Graham</a>
            <!--<a href="#">Link 3</a>
            <a href="#">Link 4</a>
            -->
        </div>
    @endauth

    <div class="content">
        <div class="container">
            @yield('content')
        </div>

        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        
        </div>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">© {{date('Y')}} Carteira +Eficiente</span>
            </div>
        </footer>

        @yield('scripts')
    </div>
</body>
</html>