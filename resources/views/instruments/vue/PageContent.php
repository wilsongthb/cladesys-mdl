<template id="page-content-template">
    <router-view></router-view>
</template>
<script>

const PageContent = {
    template: '#page-content-template',
    data () {
        return {
            msj: "Hello, VueJS Works! :D"
        }
    }
}
</script>