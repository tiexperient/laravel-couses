<!--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celke</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    
</head>
<body>

        <a href="{{ route('courses.index') }}">Listar os Cursos</a><br><br>

        <a href="{{ route('status-course.index') }}">Listar Status dos Cursos</a><br><br>

        <hr><br><br>
        <a href="{{ route('users.index') }}">Listar Usuários</a><br><br>
        <a href="{{ route('status-user.index') }}">Listar Status de Usuários</a><br><br>

        @yield('content')
</body>
</html>
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Celke</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1f2937;
            color: #fff;
            padding: 25px 20px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        }

        .sidebar h2 {
            color: #fff;
            font-size: 22px;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            color: #e5e7eb;
            text-decoration: none;
            padding: 10px 12px;
            margin-bottom: 10px;
            border-radius: 6px;
            transition: 0.3s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #374151;
            color: #fff;
            transform: translateX(5px);
        }

        hr {
            border: none;
            border-bottom: 1px solid #4b5563;
            margin: 20px 0;
        }

        /* CONTEÚDO */
        .content {
            margin-left: 280px;
            padding: 20px 50px 40px 50px; /* sem espaço no topo */
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Painel Celke</h2>
        <a href="{{ route('dashboard.index') }}">⚙️ Dashboard</a>

        <a href="{{ route('courses.index') }}">📘 Listar Cursos</a>

        <a href="{{ route('status-course.index') }}">🔎 Status dos Cursos</a>

        <hr>

        <a href="{{ route('users.index') }}">👤 Usuários</a>
        <a href="{{ route('status-user.index') }}">🔐 Status de Usuários</a>
        <a href="{{ route('profile.show') }}">🛠️ Perfil</a>

        <hr>

        <a href="{{ route('logout') }}">⏻ Sair</a>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
