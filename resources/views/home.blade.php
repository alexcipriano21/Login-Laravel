<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bienvenido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <style>
        .home-content {
            text-align: center;
            color: #fff;
            padding: 20px;
        }

        .user-icon {
            font-size: 80px;
            margin-bottom: 20px;
            color: #ef41a7; 
            background: linear-gradient(45deg, #ef41a7, #3b2072);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .btn-logout {
            display: inline-block;
            width: 100%;
            height: 45px;
            background: #ef41a7;
            border: none;
            outline: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            line-height: 45px;
            transition: .5s;
        }

        .btn-logout:hover {
            background: #3b2072;
            box-shadow: 0 0 10px #ef41a7;
        }

        .badge {
            background: rgba(255, 255, 255, 0.1);
            padding: 5px 15px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="home-content">
            <div class="user-icon">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            
            <h1>¡Hola de nuevo!</h1>
            <p>Bienvenido al panel de control.</p>

            <div style="margin-bottom: 40px;">
                <span class="badge">
                    <i class="fa-solid fa-user-tag" style="margin-right: 8px;"></i>
                    <strong>{{ session('usuario') ?? 'Usuario' }}</strong>
                </span>
            </div>

            <a href="{{ route('login') }}" class="btn-logout">
                <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</body>
</html>