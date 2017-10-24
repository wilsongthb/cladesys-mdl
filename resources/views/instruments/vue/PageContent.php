<template id="page-content-template">
    
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <router-view></router-view>
            </div>
        </div>
    </div>
    
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