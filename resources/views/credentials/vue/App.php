<template id="app-template">
    <div>
        CREDENTIALS
        <p>
            <router-link to="/foo">Foo</router-link>
            <router-link to="/bar">Bar</router-link>
        </p>
        <router-view></router-view>
    </div>
</template>
<script>
const App = {
    components: {
    },
    template: '#app-template'
}
</script>