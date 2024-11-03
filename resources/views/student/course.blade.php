@extends('student.app')

@section('content-body')

    <script>
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

            const contentsContainer = moduleClone.querySelector('.contents-container');
            const omitContentsButton = moduleClone.querySelector('.omit-contents');
            const displayContentsButton = moduleClone.querySelector('.display-contents');

            // Configurar os botões para alternar visibilidade
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

            contentClone.querySelector('.displayed').checked = content.viewed
            contentClone.querySelector('.displayed').onclick = (event) => alterSituationContent(event.target, content.id);

            return contentClone;
        }

        function toggleVisibility(element, showButton, hideButton) {
            element.classList.toggle('hidden');
            showButton.style.display = element.classList.contains('hidden') ? '' : 'none';
            hideButton.style.display = element.classList.contains('hidden') ? 'none' : '';
        }

        async function alterSituationContent(element, idContent){
            try {
                const response = await requestFetch(`/api/content/alterSituation/${idContent}`, 'GET');
                message(response)
            } catch (error) {
                console.log('view content error => ', error);
            }
        }

    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Lista de Curso</h2>
            </div>
        </div>
            
        <div id="courses-container" class="mt-2"></div>

        @include('student.template.courseTemplate')
        @include('student.template.moduleTemplate')
        @include('student.template.contentTemplate')

    </div>

    <script>
        allCourse();
    </script>

@endsection