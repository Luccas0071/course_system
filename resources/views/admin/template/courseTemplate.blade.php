<template id="course-template">
    <div class="course-card">
        <div class="container-main">

            <div class="container-information">
                <h4 class="course-title"></h4>
                <p class="course-description"></p>
            </div>

            <div class="container-additional-information" style="display: none">
                <p class="information-quantity-module">
                    Quantidade Modulo:
                    <span class="quantity-module"></span>
                </p>
                <p class="information-quantity-content">
                    Quantidade Conteudo:
                    <span class="quantity-content"></span>
                </p>
            </div>

            <div class="container-button">
                <button class="btn btn-outline-primary omit-modules hidden" style="display: none">
                    <span class="material-icons">keyboard_arrow_up</span>
                </button>
                <button class="btn btn-outline-primary display-modules">
                    <span class="material-icons">keyboard_arrow_down</span>
                </button>
                <button class="btn btn-outline-primary add-module-btn">
                    <span class="material-icons">format_list_bulleted_add</span>
                </button>
                <button class="btn btn-outline-primary edit-course-btn">
                    <span class="material-icons">edit</span>
                </button>
                <button class="btn btn-outline-danger delete-course-btn">
                    <span class="material-icons">close</span>
                </button>
            </div>

        </div>

        <div class="modules-container hidden"></div>
    </div>
</template>