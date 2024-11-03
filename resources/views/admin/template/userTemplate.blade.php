<template id="user-template">
    <div class="user-card">
        <div class="container-main">
            <div class="container-information">
                <h6 class="user-name"></h6>
                <p class="user-email"></p>
            </div>
            <div class="container-additional-information">
                <p>
                    Quantidade Curso: 
                    <span class="user-count-course"></span>
                </p>
            </div>
            
            <div class="container-button">
                <button class="btn btn-outline-primary edit-user-btn">
                    <span class="material-icons">edit</span>
                </button>
                <button class="btn btn-outline-danger delete-user-btn">
                    <span class="material-icons">close</span>
                </button>
            </div>
        </div>
    </div>
</template>