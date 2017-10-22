<template id="links-navigation-template">
    <nav class="mdl-navigation">
    <router-link class="mdl-navigation__link" to="/">HOME</router-link>
        <router-link class="mdl-navigation__link" to="/foo">Go to Foo</router-link>
        <router-link class="mdl-navigation__link" to="/bar">Go to Bar</router-link>
        <router-link class="mdl-navigation__link" to="/doctors">Go to Doctors</router-link>
        <!-- <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">sadasd</a> -->
    </nav>
</template>
<script>
const LinksNavigation = {
    template: '#links-navigation-template'
}
</script>