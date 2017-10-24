<template id="top-menu-template">
    <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">CLADESYS - LABORATORIO </span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-layout--large-screen-only">
                    <!-- <links-navigation></links-navigation> -->
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title">Title</span>
            <links-navigation></links-navigation>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
                    <div class="mdl-cell mdl-cell--8-col mdl-cell--8-col-tablet mdl-cell--4-col-phone">
                        <page-content></page-content>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
var TopMenu = {
    template: '#top-menu-template',
    components: {
        'PageContent': PageContent,
        'LinksNavigation': LinksNavigation
    }
}
</script>