<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('./css/login-style.css') }}">
</head>
<body>

    
    <div id="message"></div>
    
    <div class="container-body">
        <form id="loginForm">
            <div class="container-form">
                <div class="input-email">
                    <label for="email" title="E-mail" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" required><br>
                </div>

                <div class="input-senha">
                    <label for="password" title="Senha" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" required><br>
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('token', data.token);
                    data.status === true ? window.location.href = '/admin' : window.location.href = '/student';
                } else {
                    document.getElementById('message').textContent = data.error || 'Login failed';
                }
            } catch (error) {
                document.getElementById('message').textContent = 'An error occurred';
            }
        });
    </script>
</body>
</html>
