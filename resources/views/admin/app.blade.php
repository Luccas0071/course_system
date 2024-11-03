<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Maturial Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    {{-- Font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    {{-- Css --}}
    <link rel="stylesheet" href="{{ asset('./css/style.css') }}">

    <title>Cursos - @yield('title') </title>

</head>
<body>
    <script>
        async function logout() {
            try {
                var response = await requestFetch('/api/logout', 'GET')                
                if(response.success){
                    localStorage.removeItem('token');
                    window.location.href = '/login'
                }
            } catch (error) {
                console.log('Logout error => ', error);
            }
        }
    </script>
 
    <script src="{{ mix('js/app.js') }}"></script>

    <div id="notification" class="notification"></div>
    
    <nav class="navbar navbar-dark bg-dark">
        <div class="container justify-content-between">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.course')}}">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user')}}">Usuários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.report')}}">Relatórios</a>
                </li>
    
            </ul>
            <button type="button" class="btn btn-outline-light logout" onclick="logout()">
                <span class="material-icons">logout</span>
            </button>
        </div>
    </nav>

    <div class="container">
        @yield('content-body')
    </div>

    <script>
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }else {
            fetch('/api/authenticated', {
                headers: { 'Authorization': `Bearer ${token}` }
            })
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                if(data.status === false){
                    document.getElementById('container-users-tab').style.display = 'none'
                    document.getElementById('container-report-tab').style.display = 'none'
                }
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.href = '/login';
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>