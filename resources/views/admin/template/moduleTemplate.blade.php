<template id="module-template">
    <div class="module-card">
        <div class="container-main">
            <div class="container-information">
                <h5 class="module-title"></h5>
                <p class="module-description"></p>
            </div>
            <div class="container-button">
                <button class="btn btn-outline-primary omit-contents hidden"  style="display: none">
                    <span class="material-icons">keyboard_arrow_up</span>
                </button>
                <button class="btn btn-outline-primary display-contents">
                    <span class="material-icons">keyboard_arrow_down</span>
                </button>
                <button class="btn btn-outline-primary add-content-btn">
                    <span class="material-icons">post_add</span>
                </button>
                <button class="btn btn-outline-primary edit-module-btn">
                    <span class="material-icons">edit</span>
                </button>
                <button class="btn btn-outline-danger delete-module-btn">
                    <span class="material-icons">close</span>
                </button>
            </div>
        </div>
        <div class="contents-container hidden"></div>
    </div>
</template>