<template id="page-content-template">
    <div>
        <h1>CHARISMA LABORATORIO</h1>
        <p>{{msj}} </p>
    </div>
</template>
<script>
var PageContent = {
    template: '#page-content-template',
    data () {
        return {
            msj: "Hello, VueJS Works! :D"
        }
    }
}
</script>