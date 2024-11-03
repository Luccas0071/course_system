<div class="modal fade" id="courseModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title-modal">Adicionar Curso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="courseForm" action="#"  method="POST">
                    
                    <input type="hidden" name="idCourse" class="idCourse" id="idCourse">
                    <input type="hidden" name="idModule" class="idModule" id="idModule">
                    <input type="hidden" name="idContent" class="idContent" id="idContent">

                    <div class="mb-3" id="input-unique-code">
                        <label for="uniqueCode" title="Título" class="form-label">Codigo Unico</label>
                        <input type="text" name="uniqueCode" class="uniqueCode form-control" id="uniqueCode" disabled>
                    </div>

                    <div class="mb-3" id="input-title">
                        <label for="title" title="Título" class="form-label">Titulo</label>
                        <input type="text" name="title" class="title form-control" id="title">
                    </div>
                    
                    <div class="mb-3" id="textarea-description">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="description form-control" name="description" id="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3" id="textarea-content">
                        <label for="content" class="form-label">Conteúdo</label>
                        <textarea class="content form-control" name="content" id="content" rows="3"></textarea>
                    </div>
        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-add-course"   onclick="addCourse()"   style="display: none">Salvar Curso</button>
                        <button type="button" class="btn btn-primary" id="btn-add-module"   onclick="addModule()"   style="display: none">Salvar Modulo</button>
                        <button type="button" class="btn btn-primary" id="btn-add-content"  onclick="addContent()"  style="display: none">Salvar Conteudo</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>