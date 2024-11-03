@extends('admin.app')
@section('title', 'Lista')
@section('content-body')

    <script >

        typefunction = {
            'course': 1,
            'module': 2,
            'content': 3,
        }

        function toggleVisibility(element, showButton, hideButton) {
            element.classList.toggle('hidden');
            showButton.style.display = element.classList.contains('hidden') ? '' : 'none';
            hideButton.style.display = element.classList.contains('hidden') ? 'none' : '';
        }

        // MODAL
        async function openModalListUsers(idContent){

            const container = document.getElementById('list-users');
            container.innerHTML = '';

            try {
                const response = await requestFetch(`/api/content/usersViewed/${idContent}`, 'GET')

                if(response.data.length > 0){
                    processListUsers(response.data);
                    document.getElementById('not-users').style.display = 'none';
                }else{
                    document.getElementById('not-users').style.display = '';
                }
            } catch (error) {
                console.log('All users content error => ', error);
            }

            displayModal('usersViewedModal');
        }

        function processListUsers(data) {
            const container = document.getElementById('list-users');
            container.innerHTML = '';

            for (const user of data) {
                const element = createUsersElement(user);
                container.appendChild(element);
            }
        }

        function createUsersElement(user) {
            
            const template = document.getElementById('user-template');
            const contentClone = template.content.cloneNode(true);

            contentClone.querySelector('.user-name').textContent = user.name;
            contentClone.querySelector('.user-email').textContent = user.email;

            contentClone.querySelector('.container-additional-information').style.display = 'none';
            contentClone.querySelector('.container-button').style.display = 'none';

            return contentClone;
        }

        async function openModal(type, idCourse = null, idModule = null, idContent = null) {

            document.getElementById("idCourse").value = "";
            document.getElementById("idModule").value = "";
            document.getElementById("idContent").value = "";

            document.getElementById("uniqueCode").value = "";
            document.getElementById("title").value = "";
            document.getElementById("description").value = "";
            document.getElementById("content").value = "";

            document.getElementById("input-unique-code").style.display = "none";
            document.getElementById("textarea-description").style.display = "none";
            document.getElementById("textarea-content").style.display = "none";

            document.getElementById("btn-add-course").style.display = "none";
            document.getElementById("btn-add-module").style.display = "none";
            document.getElementById("btn-add-content").style.display = "none";

            if(type == typefunction.course){
                modalCourse(idCourse)
            }
            if(type == typefunction.module){
                modalModule(idCourse, idModule)
            }
            if(type == typefunction.content){
                modalContent(idModule, idContent)
            }

            displayModal('courseModal')
        }

        async function modalCourse(idCourse) {

            document.getElementById("textarea-description").style.display = "inline";
            document.getElementById('title-modal').textContent  = 'Adicionar Curso';

            document.getElementById("btn-add-course").style.display = "inline";

            if(idCourse){
                const course = await getCourse(idCourse);
                
                document.getElementById("input-unique-code").style.display = "inline";

                document.getElementById('idCourse').value = course.id;
                document.getElementById('uniqueCode').value = course.unique_code;
                document.getElementById('title').value = course.title;
                document.getElementById('description').value = course.description;
            }
        }

        async function modalModule(idCourse, idModule = null){

            document.getElementById('idCourse').value = idCourse;
            document.getElementById('title-modal').textContent  = 'Adicionar Modulo';

            document.getElementById("textarea-description").style.display = "inline";
            document.getElementById("btn-add-module").style.display = "inline";

            if(idModule){
                const module = await getModule(idModule);

                document.getElementById('title-modal').textContent  = 'Editar Modulo';

                document.getElementById('idModule').value = module.id;
                document.getElementById('title').value = module.title;
                document.getElementById('description').value = module.description;
            }
        }

        async function modalContent(idModule, idContent = null){

            document.getElementById('idModule').value = idModule;
            document.getElementById('title-modal').textContent  = 'Adicionar conteúdo';

            document.getElementById("textarea-content").style.display = "inline";
            document.getElementById("btn-add-content").style.display = "inline";

            if(idContent){
                const content = await getContent(idContent);

                document.getElementById('title-modal').textContent  = 'Editar conteúdo';

                document.getElementById('idContent').value = content.id;
                document.getElementById('title').value = content.title;
                document.getElementById('content').value = content.contents;
            }
        }

        function displayModal(modal){
            const myModal = new bootstrap.Modal(document.getElementById(modal));
            myModal.show();
        }

        function closeModal(modal){
            document.getElementById(modal).style.display = 'none';
            document.querySelector('.modal-backdrop').remove('show');
        }

        // COURSE
        async function allCourse(){
            try{
                const response = await requestFetch('/api/course', 'GET');
                processCourse(response.data)
            } catch (error) {
                console.log('All course error => ', error);
            }
        }

        function processCourse(data) {
            const container = document.getElementById('courses-container');
            container.innerHTML = '';

            for (const course of data) {
                const courseElement = createCourseElement(course);
                container.appendChild(courseElement);
            }
        }

        function createCourseElement(course) {

            const template = document.getElementById('course-template');
            const courseClone = template.content.cloneNode(true);

            courseClone.querySelector('.course-title').textContent = course.title;
            courseClone.querySelector('.course-description').textContent = course.description;

            courseClone.querySelector('.add-module-btn').onclick = () => openModal(2, course.id);
            courseClone.querySelector('.edit-course-btn').onclick = () => openModal(1, course.id);
            courseClone.querySelector('.delete-course-btn').onclick = () => deleteCourse(course.id);

            const modulesContainer = courseClone.querySelector('.modules-container');
            const omitModulesButton = courseClone.querySelector('.omit-modules');
            const displayModulesButton = courseClone.querySelector('.display-modules');

            omitModulesButton.onclick = () => toggleVisibility(modulesContainer, displayModulesButton, omitModulesButton);
            displayModulesButton.onclick = () => toggleVisibility(modulesContainer, displayModulesButton, omitModulesButton);

            for (const module of course.modules) {
                const moduleElement = createModuleElement(module, course.id);
                modulesContainer.appendChild(moduleElement);
            }
      
            return courseClone;
        }

        function createModuleElement(module, courseId) {
            const template = document.getElementById('module-template');
            const moduleClone = template.content.cloneNode(true);

            moduleClone.querySelector('.module-title').textContent = module.title;
            moduleClone.querySelector('.module-description').textContent = module.description;

            moduleClone.querySelector('.edit-module-btn').onclick = () => openModal(2, courseId, module.id);
            moduleClone.querySelector('.add-content-btn').onclick = () => openModal(3, courseId, module.id);
            moduleClone.querySelector('.delete-module-btn').onclick = () => deleteModule(module.id);

            const contentsContainer = moduleClone.querySelector('.contents-container');
            const omitContentsButton = moduleClone.querySelector('.omit-contents');
            const displayContentsButton = moduleClone.querySelector('.display-contents');

            omitContentsButton.onclick = () => toggleVisibility(contentsContainer, displayContentsButton, omitContentsButton);
            displayContentsButton.onclick = () => toggleVisibility(contentsContainer, displayContentsButton, omitContentsButton);

            for (const content of module.contents) {
                const contentElement = createContentElement(content, module.id);
                contentsContainer.appendChild(contentElement);
            }

            return moduleClone;
        }

        function createContentElement(content, moduleId) {
            const template = document.getElementById('content-template');
            const contentClone = template.content.cloneNode(true);

            contentClone.querySelector('.content-title').textContent = content.title;
            contentClone.querySelector('.content-description').textContent = content.contents;

            contentClone.querySelector('.user-viewed-content-btn').onclick = () => openModalListUsers(content.id);
            contentClone.querySelector('.edit-content-btn').onclick = () => openModal(3, '', moduleId, content.id);
            contentClone.querySelector('.delete-content-btn').onclick = () => deleteContent(content.id);

            return contentClone;
        }

        async function getCourse(id) {
            try {
                const response = await requestFetch(`/api/course/${id}`, 'GET')
                return response.data
            } catch (error) {
                console.log('Get course error => ', error);
            }
        }

        async function addCourse() {

            const id            = document.getElementById('idCourse').value;
            const title         = document.getElementById('title').value;
            const description   = document.getElementById('description').value;

            body =  {id, title, description }

            if(id){
                url = '/api/course/update';
                method = 'PUT'
            }else{
                url = '/api/course/create';
                method = 'POST'
            }

            try {
                var response = await requestFetch(url, method, body)
                message(response)
                if(response.success) { 
                    allCourse() 
                    closeModal('courseModal') 
                }
            } catch (error) {
                console.log('Create course error => ', error);
            }
        }

        async function deleteCourse(id){
            try {
                var response = await requestFetch(`/api/course/delete/${id}`, 'DELETE')
                message(response)
                if(response.success){
                     allCourse()
                }
            } catch (error) {
                console.log('Delete error => ', error);
            }
        }

        // MODULE
        async function getModule(id) {
            try {
                const response = await requestFetch(`/api/module/${id}`, 'GET')
                return response.data
            } catch (error) {
                console.log('Get Module error => ', error);
            }
        }

        async function addModule() {

            const id            = document.getElementById('idModule').value;
            const course_id     = document.getElementById('idCourse').value;
            const title         = document.getElementById('title').value;
            const description   = document.getElementById('description').value;

            body =  {id, title, description, course_id }

            if(id){
                url = '/api/module/update';
                method = 'PUT'
            }else{
                url = '/api/module/create';
                method = 'POST'
            }

            try {
                var response = await requestFetch(url, method, body)
                message(response)
                if(response.success){ 
                    allCourse() 
                    closeModal('courseModal')  
                }
            } catch (error) {
                console.log('Create error => ', error);
            }
        }

        async function deleteModule(id){
            try {
                var response = await requestFetch(`/api/module/delete/${id}`, 'DELETE')
                message(response)
                if(response.success){
                     allCourse() 
                }
            } catch (error) {
                console.log('Delete Module error => ', error);
            }
        }

        // CONTENT
        async function getContent(id) {
            try {
                const response = await requestFetch(`/api/content/${id}`, 'GET')
                return response.data
            } catch (error) {
                console.log('Get content error => ', error);
            }
        }
        
        async function addContent() {

            const id            = document.getElementById('idContent').value;
            const module_id     = document.getElementById('idModule').value;
            const title         = document.getElementById('title').value;
            const contents      = document.getElementById('content').value;

            body =  {id, title, contents, module_id }

            if(id){
                url = '/api/content/update';
                method = 'PUT'
            }else{
                url = '/api/content/create';
                method = 'POST'
            }

            try {
                var response = await requestFetch(url, method, body)
                message(response)
                if(response.success){
                    allCourse()
                    closeModal('courseModal')
                }
            } catch (error) {
                console.log('Create content error => ', error);
            }
        }

        async function deleteContent(id){
            try {
                var response = await requestFetch(`/api/content/delete/${id}`, 'DELETE')
                message(response)
                if(response.success){ 
                    allCourse()
                }
            } catch (error) {
                console.log('Delete content error => ', error);
            }
        }
        
    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h2>Lista de Curso</h2>
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-primary" onclick="openModal(1)">
                    Adicionar
                </button>
            </div>
        </div>
            
        <div id="courses-container" class="mt-2"></div>

        @include('admin.modal.courseModal')
        @include('admin.modal.usersViewedModal')
        
        @include('admin.template.userTemplate')
        @include('admin.template.courseTemplate')
        @include('admin.template.moduleTemplate')
        @include('admin.template.contentTemplate')

    </div>

    <script>
        allCourse();
    </script>

@endsection