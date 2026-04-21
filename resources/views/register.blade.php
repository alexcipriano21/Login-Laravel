<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Laravel Auth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="wrapper">
        <div class="form-wrapper sign-up active">
            <form id="registerForm">
                @csrf
                <h2>Sign Up</h2>
                <div class="input-group">
                    <input type="text" name="nombre" id="nombre" required>
                    <label>Full Name</label>
                </div>
                <div class="input-group">
                    <input type="email" name="email" id="email" required>
                    <label>Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" required>
                    <label>Password</label>
                </div>
                
                <button type="submit" id="btnRegister">Sign Up</button>

                <div class="signUp-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btnRegister');
            btn.disabled = true;
            btn.innerText = 'Creando cuenta...';

            const formData = {
                nombre: document.getElementById('nombre').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };

            try {
                const response = await fetch('/api/registro', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.status === 201) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Cuenta creada correctamente. Ya puedes iniciar sesión.',
                        background: '#1b1b1b',
                        color: '#fff',
                        timer: 2500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    let errorMsg = 'Error en el registro';
                    if (data.email) errorMsg = data.email[0];
                    else if (data.message) errorMsg = data.message;

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg,
                        background: '#1b1b1b',
                        color: '#fff'
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo conectar con el servidor',
                    background: '#1b1b1b',
                    color: '#fff'
                });
            } finally {
                btn.disabled = false;
                btn.innerText = 'Sign Up';
            }
        });
    </script>
</body>
</html>
