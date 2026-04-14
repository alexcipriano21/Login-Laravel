<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Login & Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="wrapper">
        
        <div class="form-wrapper sign-in active">
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <h2>Sign In</h2>
                <div class="input-group">
                    <input type="email" name="correo" value="{{ old('correo') }}" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena" required>
                    <label>Password</label>
                </div>
                <button type="submit">Sign In</button>
                <div class="signUp-link">
                    <p><a href="#" class="forgotPassword-link">Forgot Password?</a></p>
                    <p>Don't have an account? <a href="#" class="signUpBtn-link">Sign Up</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper sign-up">
            <form method="POST" action="{{ route('registro.post') }}">
                @csrf
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="text" name="usuario" value="{{ old('usuario') }}" required>
                    <label>Username</label>
                </div>
                <div class="input-group">
                    <input type="email" name="correo" value="{{ old('correo') }}" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena" required>
                    <label>Password</label>
                </div>
                <button type="submit">Sign Up</button>
                <div class="signUp-link">
                    <p>Already have an account? <a href="#" class="signInBtn-link">Sign In</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper forgot-password-form">
            <form method="POST" action="{{ route('olvidar.post') }}">
                @csrf
                <h2>Forgot Password</h2>
                <div class="input-group">
                    <input type="email" name="correo" required>
                    <label>Enter your Email</label>
                </div>
                <button type="submit">Send Reset Link</button>
                <div class="signUp-link">
                    <p><a href="#" class="signInBtn-link">Back to Sign In</a></p>
                    <p><a href="#" class="changePassword-link">Change Password</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper change-password-form">
            <form method="POST" action="{{ route('actualizar.post') }}">
                @csrf
                <h2>Change Password</h2>
                <div class="input-group">
                    <input type="text" name="token" required placeholder="Ingresa el token enviado">
                    <label>Reset Token</label>
                </div>
                <div class="input-group">
                    <input type="email" name="correo" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena" required>
                    <label>New Password</label>
                </div>
                <button type="submit">Update Password</button>
                <div class="signUp-link">
                    <p><a href="#" class="signInBtn-link">Back to Sign In</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        const mensajeExito = "{{ session('swal_success') }}";
        const errorValidacion = "{{ $errors->first() }}";

        if (mensajeExito) {
            Swal.fire({
                icon: 'success',
                title: '¡Todo listo!',
                text: mensajeExito,
                confirmButtonColor: '#4e73df',
                background: '#1b1b1b',
                color: '#fff',      
                timer: 3000,          
                timerProgressBar: true
            });
        }

        if (errorValidacion) {
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: errorValidacion,
                confirmButtonColor: '#f4157e',
                background: '#1b1b1b',
                color: '#fff'        
            });
        }
    </script>
</body>
</html>