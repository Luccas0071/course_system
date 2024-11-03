async function allCourse() {
    const response = await requestFetch('/api/course', 'GET');
    processCourse(response)
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
        // courseClone.querySelector('.course').appendChild(moduleElement);
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

    contentClone.querySelector('.edit-content-btn').onclick = () => openModal(3, '', moduleId, content.id);
    contentClone.querySelector('.delete-content-btn').onclick = () => deleteContent(content.id);

    return contentClone;
}

async function getCourse(id) {
    try {
        return response = await requestFetch(`/api/course/${id}`, 'GET')
    } catch (error) {
        console.log('Get course error => ', error);
    }
}

async function addCourse() {

    const id = document.getElementById('idCourse').value;
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    body = { id, title, description }

    if (id) {
        url = '/api/course/update';
        method = 'PUT'
    } else {
        url = '/api/course/create';
        method = 'POST'
    }

    try {
        var response = await requestFetch(url, method, body)
        if (response.success) { allCourse() }
    } catch (error) {
        console.log('Create course error => ', error);
    }
}

async function deleteCourse(id) {
    try {
        var response = await requestFetch(`/api/course/delete/${id}`, 'DELETE')
        if (response.success) { allCourse() }
    } catch (error) {
        console.log('Delete error => ', error);
    }
}