<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title-modal">Cadastrar Usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="userForm" action="#"  method="POST">
                    
                    <input type="hidden" name="idUser" class="idUser" id="idUser">

                    <div class="mb-3">
                        <label for="name" title="Nome" class="form-label">Nome</label>
                        <input type="text" name="name" class="name form-control" id="name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" title="E-mail" class="form-label">E-mail</label>
                        <input type="email" name="email" class="email form-control" id="email">
                    </div>

                    <div class="mb-3 input-password">
                        <label for="password" title="E-mail" class="form-label">Senha</label>
                        <input type="password" name="password" class="password form-control" id="password">
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input"  value="" id="status">
                            <label class="form-check-label" for="status">
                                Administrador
                            </label>
                        </div>
                    </div>
           
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-add-user" onclick="addUser()">Salvar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>