<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Laravel Auth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <div class="form-wrapper active" id="forgotStep">
            <form id="forgotForm">
                @csrf
                <h2>Forgot Password</h2>
                <div class="input-group">
                    <input type="email" name="email" id="emailForgot" required>
                    <label>Enter your Email</label>
                </div>
                <button type="submit" id="btnForgot">Send Reset Link</button>
                <div class="signUp-link">
                    <p><a href="{{ route('login') }}">Back to Sign In</a></p>
                    <p><a href="javascript:void(0)" onclick="showResetStep()">Already have a token?</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper" id="resetStep">
            <form id="resetForm">
                @csrf
                <h2>Reset Password</h2>
                <div class="input-group">
                    <input type="text" name="token" id="token" required placeholder="Paste token here">
                    <label>Reset Token</label>
                </div>
                <div class="input-group">
                    <input type="email" name="email" id="emailReset" required>
                    <label>Confirm Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="newPassword" required>
                    <label>New Password</label>
                </div>
                <button type="submit" id="btnReset">Update Password</button>
                <div class="signUp-link">
                    <p><a href="javascript:void(0)" onclick="showForgotStep()">Back to Request Email</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showResetStep() {
            document.getElementById('forgotStep').classList.remove('active');
            document.getElementById('resetStep').classList.add('active');
        }

        function showForgotStep() {
            document.getElementById('resetStep').classList.remove('active');
            document.getElementById('forgotStep').classList.add('active');
        }

        document.getElementById('forgotForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btnForgot');
            btn.disabled = true;
            btn.innerText = 'Enviando...';

            const email = document.getElementById('emailForgot').value;

            try {
                const response = await fetch('/api/olvide-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Token Generado',
                        text: 'Copia el token: ' + data.reset_token,
                        background: '#1b1b1b',
                        color: '#fff'
                    }).then(() => {
                        document.getElementById('emailReset').value = email;
                        document.getElementById('token').value = data.reset_token;
                        showResetStep();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error || 'No se pudo generar el token',
                        background: '#1b1b1b',
                        color: '#fff'
                    });
                }
            } catch (error) {
                console.error(error);
            } finally {
                btn.disabled = false;
                btn.innerText = 'Send Reset Link';
            }
        });

        document.getElementById('resetForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btnReset');
            btn.disabled = true;
            btn.innerText = 'Actualizando...';

            const formData = {
                email: document.getElementById('emailReset').value,
                token: document.getElementById('token').value,
                password: document.getElementById('newPassword').value
            };

            try {
                const response = await fetch('/api/actualizar-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Contraseña Cambiada!',
                        text: 'Ya puedes iniciar sesión con tu nueva clave.',
                        background: '#1b1b1b',
                        color: '#fff',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.error || 'Token o datos inválidos',
                        background: '#1b1b1b',
                        color: '#fff'
                    });
                }
            } catch (error) {
                console.error(error);
            } finally {
                btn.disabled = false;
                btn.innerText = 'Update Password';
            }
        });
    </script>
</body>

</html>