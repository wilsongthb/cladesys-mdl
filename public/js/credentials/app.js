var Application = Vue.component('application', {
    template: '#application-template',
    data: function(){
        return {
            msj: 'This app is execute'
        }
    }
})


var app = new Vue({
    el: '#app'
})