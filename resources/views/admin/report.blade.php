@extends('admin.app')
@section('title', 'Relatórios')
@section('content-body')

    <script>
        // Report A
        async function getReportA(){
            try {
                const response = await requestFetch(`/api/reportA`, 'GET');
                processReportA(response.data);
            } catch (error) {
                console.log('Error display report A => ', error);
            }
        }

        function processReportA(data) {
            const containerReport = document.getElementById('content-user-report');
            containerReport.innerHTML = '';

            for (const user of data) {
                const element = createUserElementReport(user);
                containerReport.appendChild(element);
            }
        }
        
        function createUserElementReport(user) {
            
            const template = document.getElementById('user-template');
            const contentClone = template.content.cloneNode(true);

            contentClone.querySelector('.user-name').textContent = user.name;
            contentClone.querySelector('.user-email').textContent = user.email;

            contentClone.querySelector('.user-count-course').textContent = user.quantity_courses;
            contentClone.querySelector('.container-button').style.display = 'none';

            return contentClone;
        }

        // Report B
        async function getReportB() {
            try {
                const response = await requestFetch(`/api/reportB`, 'GET');
                processReportB(response.data);
            } catch (error) {
                console.log('Error display report B => ', error);
            }
        }

        function processReportB(data) {
            const containerReport = document.getElementById('content-course-report');
            containerReport.innerHTML = '';

            for (const course of data) {
                const element = createCourseElementReport(course);
                containerReport.appendChild(element);
            }
        }

        function createCourseElementReport(course) {
            
            const template = document.getElementById('course-template');
            const contentClone = template.content.cloneNode(true);
            
            contentClone.querySelector('.course-title').textContent = course.title;
            contentClone.querySelector('.course-description').textContent = course.description;
            contentClone.querySelector('.quantity-content').textContent = course.quantity_contents;

            contentClone.querySelector('.container-additional-information').style.display = '';
            contentClone.querySelector('.information-quantity-module').style.display = 'none';
            contentClone.querySelector('.container-button').style.display = 'none';

            return contentClone;
        }

        // Report C
        async function getReportC() {
            try {
                const response = await requestFetch(`/api/reportC`, 'GET');
                processReportC(response.data);
            } catch (error) {
                console.log('Error display report C => ', error);
            }
        }

        function processReportC(data) {
            const containerReport = document.getElementById('content-courses-report');
            containerReport.innerHTML = '';

            for (const course of data) {
                const element = createCoursesElementReport(course);
                containerReport.appendChild(element);
            }
        }

        function createCoursesElementReport(courses) {
            const template = document.getElementById('course-template');
            const contentClone = template.content.cloneNode(true);

            contentClone.querySelector('.course-title').textContent = courses.title;
            contentClone.querySelector('.course-description').textContent = courses.description;
            contentClone.querySelector('.quantity-module').textContent = courses.quantity_module;
            contentClone.querySelector('.quantity-content').textContent = courses.quantity_content;

            contentClone.querySelector('.container-additional-information').style.display = '';
            contentClone.querySelector('.container-button').style.display = 'none';

            return contentClone;
        }
        
        // Report D
        async function getReportD() {
            try {
                const response = await requestFetch(`/api/reportD`, 'GET');
                processReportD(response.data);
            } catch (error) {
                console.error('Error display report D => ', error);
            }
        }

        function processReportD(data) {
            const containerReport = document.getElementById('content-container-report');
            containerReport.innerHTML = '';

            for (const content of data) {
                const element = createContentElementReport(content);
                containerReport.appendChild(element);
            }
        }

        function createContentElementReport(content) {
            const template = document.getElementById('content-template');
            const contentClone = template.content.cloneNode(true);

            contentClone.querySelector('.content-title').textContent = content.title;
            contentClone.querySelector('.content-description').textContent = content.contents;
            contentClone.querySelector('.title-course-content').textContent = content.course_title;
            
            contentClone.querySelector('.container-button').style.display = 'none';
            contentClone.querySelector('.content-card').classList.replace('content-card', 'content-card-report');

            return contentClone;
        }
    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Relatórios</h2>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="report-a-tab" data-bs-toggle="tab" data-bs-target="#report-a" type="button" role="tab" aria-controls="report-a" aria-selected="false">
                    Relatório A
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="report-b-tab" data-bs-toggle="tab" data-bs-target="#report-b" type="button" role="tab" aria-controls="report-b" aria-selected="false">
                    Relatório B
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="report-c-tab" data-bs-toggle="tab" data-bs-target="#report-c" type="button" role="tab" aria-controls="report-c" aria-selected="false">
                    Relatório C
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="report-d-tab" data-bs-toggle="tab" data-bs-target="#report-d" type="button" role="tab" aria-controls="report-d" aria-selected="false">
                    Relatório D
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="report-a" aria-labelledby="report-a-tab">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Usuário</h5>
                            <p>Relatório de usuário que possui mais cursos.</p>
                        </div>
                    </div>

                    <div id="content-user-report" class="mt-2"></div>

                </div>
            </div>

            <div class="tab-pane fade" id="report-b" aria-labelledby="report-b-tab">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Curso</h5>
                            <p>Relatório de curso que possui mais conteudo.</p>
                        </div>
                    </div>
                    <div id="content-course-report" class="mt-2"></div>
                </div>
            </div>

            <div class="tab-pane fade" id="report-c" aria-labelledby="report-c-tab">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Todos os Cursos</h5>
                            <p>Relatório de cursos com quantidade de modulos e conteudos.</p>
                        </div>
                    </div>
                    <div id="content-courses-report" class="mt-2"></div>
                </div>
            </div>

            <div class="tab-pane fade" id="report-d" aria-labelledby="report-d-tab">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <h5>Conteudos</h5>
                            <p>Relatório de conteudos com o nome do curso.</p>
                        </div>
                    </div>
                    <div id="content-container-report" class="mt-2"></div>
                </div>
            </div>

        </div>
    </div>

    @include('admin.template.userTemplate')
    @include('admin.template.courseTemplate')
    @include('admin.template.contentTemplate')

    <script>
        getReportA();
        getReportB();
        getReportC();
        getReportD();
    </script>

@endsection