<template id="app-template">
    <div>
        
        <div class="navbar">
            <a class="navbar-brand" href="<?= url('/') ?>">CLADESYS</a>
            <a class="navbar-brand" href="<?= $appUrl ?> ">CREDENTIALS</a>
            
            <ul class="nav navbar-nav">
                <!-- <router-link tag="li" active-class="active" to="/"><a href="">Modulos</a></router-link> -->
                <!-- <router-link tag="li" active-class="active" to="/foo"><a href="">Foo</a></router-link> -->
                <!-- <router-link tag="li" active-class="active" to="/bar"><a href="">Bar</a></router-link> -->
                <!-- <router-link tag="li" active-class="active" to="/users"><a href="">Usuarios</a></router-link> -->
            </ul>
        </div>

        <div class="container">
            <router-view></router-view>
        </div>
        
    </div>
</template>
<script>
const App = {
    components: {
        
    },
    template: '#app-template'
}
</script>
