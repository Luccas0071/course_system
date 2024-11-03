<template id="course-template">
    <div class="course-card">
        <div class="container-main">
            <div class="information">
                <h4 class="course-title"></h4>
                <p class="course-description"></p>
            </div>
            <div class="container-button">
                <button class="btn btn-outline-primary omit-modules hidden" style="display: none">
                    <span class="material-icons">keyboard_arrow_up</span>
                </button>
                <button class="btn btn-outline-primary display-modules">
                    <span class="material-icons">keyboard_arrow_down</span>
                </button>
            </div>
        </div>
        <div class="modules-container hidden"></div>
    </div>
</template>