@extends('admin.app')
@section('title', 'Usuário')
@section('content-body')
    <script>

        async function openModalUser(id) {

            document.getElementById("idUser").value = "";
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";

            if(id){
                const user = await getUser(id);

                document.getElementById('title-modal').textContent  = 'Editar usuário';

                document.getElementById('idUser').value = user.id;
                document.getElementById('name').value = user.name;
                document.getElementById('email').value = user.email;
                let checkbox = document.getElementById('status');
                user.status === true ? checkbox.checked = true : checkbox.checked = false
            }

            displayModal();
        }

        function displayModal(){
            const myModal = new bootstrap.Modal(document.getElementById('userModal'));
            myModal.show();
        }

        function closeModal(){
            document.getElementById('userModal').style.display = 'none';
            document.querySelector('.modal-backdrop').remove('show');
        }

        async function allUsers(){
            const response = await requestFetch('/api/user', 'GET');
            processUsers(response.data)
        }

        function processUsers(data) {
            const container = document.getElementById('users-container');
            container.innerHTML = '';

            for (const user of data) {
                const userElement = createUserElement(user);
                container.appendChild(userElement);
            }
        }

        function createUserElement(user) {
            const template = document.getElementById('user-template');
            const userClone = template.content.cloneNode(true);

            userClone.querySelector('.user-name').textContent = user.name;
            userClone.querySelector('.user-email').textContent = user.email;
            userClone.querySelector('.user-count-course').textContent = user.courses_count;

            userClone.querySelector('.edit-user-btn').onclick = () => openModalUser(user.id);
            userClone.querySelector('.delete-user-btn').onclick = () => deleteUser(user.id);

            return userClone;
        }

        async function getUser(id) {
            try {
                const response = await requestFetch(`/api/user/${id}`, 'GET')
                return response.data
            } catch (error) {
                console.log('Get user error => ', error);
            }
        }
        
        async function addUser() {

            const id            = document.getElementById('idUser').value;
            const name          = document.getElementById('name').value;
            const email         = document.getElementById('email').value;
            const password      = document.getElementById('password').value;

            document.getElementById('status').checked ? status = true : status = false;

            body =  {id, name, email, password, status }
     
            if(id){
                url = '/api/user/update';
                method = 'PUT'
            }else{
                url = '/api/user/create';
                method = 'POST'
            }

            try {
                var response = await requestFetch(url, method, body)
                message(response);
                if(response.success){ 
                    allUsers() 
                    closeModal()
                }
            } catch (error) {
                console.log('Create user error => ', error);
            }
        }

        async function deleteUser(id){
            try {
                var response = await requestFetch(`/api/user/delete/${id}`, 'DELETE')
                message(response);
                if(response.success){ allUsers() }
            } catch (error) {
                console.log('Delete user error => ', error);
            }
        }

        async function authenticatedUser() {
            try {
                var response = await requestFetch('/api/authenticated', 'GET')
                return response;
            } catch (error) {
                console.log('Get user authenticated error => ', error);
            }
        }

    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h2>Lista de Usuário</h2>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-primary" onclick="openModalUser()">
                    Adicionar
                </button>
            </div>
        </div>

        <div id="users-container" class="mt-2"></div>

    </div>

    @include('admin.modal.userModal')
    @include('admin.template.userTemplate')

    <script>
        allUsers();
    </script>

@endsection