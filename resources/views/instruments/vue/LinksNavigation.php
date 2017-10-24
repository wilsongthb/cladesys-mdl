<template id="links-navigation-template">
    <ul class="nav navbar-nav">
        <!-- <router-link tag="li" active-class="active" class="nav-link" to="/"><a href="">HOME</a></router-link> -->
        <!-- <router-link tag="li" active-class="active" class="nav-link" to="/foo"><a href="">Go to Foo</a></router-link>
        <router-link tag="li" active-class="active" class="nav-link" to="/bar"><a href="">Go to Bar</a></router-link> -->
        <router-link tag="li" active-class="active" class="nav-link" to="/doctors"><a href="">Doctores</a></router-link>
        <router-link tag="li" active-class="active" class="nav-link" to="/patients"><a href="">Pacientes</a></router-link>
    </ul>
</template>
<script>
const LinksNavigation = {
    template: '#links-navigation-template'
}
</script>