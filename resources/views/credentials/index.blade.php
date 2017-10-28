
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$appName}}</title>

        <link rel="stylesheet" href="{{asset('/bower_components/bootstrap/dist/css/bootstrap.min.css')}} ">
        <link rel="stylesheet" href="{{asset('/bower_components/font-awesome/css/font-awesome.min.css')}} ">

        <link rel="stylesheet" href="{{asset('bower_components/roboto-fontface/css/roboto-condensed/roboto-condensed-fontface.css')}} ">
        <link rel="stylesheet" href="{{asset('bower_components/material-design-icons-dist/material-icons.css')}} ">
        <link rel="stylesheet" href="{{asset('css/instruments.custom.css')}} ">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="app">
            <App></App>
        </div>

        <script src="{{asset('/bower_components/jquery/dist/jquery.min.js')}} "></script>
        <script src="{{asset('/bower_components/bootstrap/dist/js/bootstrap.min.js')}} "></script>
        <script src="{{asset('bower_components/vue/dist/vue.js')}}  "></script>
        <script src="{{asset('bower_components/vue-resource/dist/vue-resource.min.js')}} "></script>
        <script src="{{asset('bower_components/vue-router/dist/vue-router.min.js')}} "></script>
        <script src="{{asset('js/laravel-vue-pagination/src/laravel-vue-pagination.js')}} "></script>
        <script src="{{asset('bower_components/vue-select/dist/vue-select.js')}} "></script>
        

        <base href="{{$baseUrl}}">
        <!-- Components -->
        @include('credentials.vue.UserLocations')
        @include('credentials.vue.UserModules')
        @include('credentials.vue.Users')

        <!-- Root Component -->
        @include('credentials.vue.App')

        <script>
            /* GLOBAL CONFIG*/
            Vue.use(VueResource)
            Vue.use(VueRouter)
            Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}'
            Vue.component('pagination', laravel_vue_pagination);
            Vue.component('v-select', VueSelect.VueSelect);
            /* CONFIGURATION */
            const AppConfig = {
                appUrl: "{{$appUrl}}",
                apiUrl: "{{$apiUrl}}",
                Config: {!! json_encode(config('dev.credentials')) !!}
            }
            const Foo = { template: '<div>foo</div>' }
            const Bar = { template: '<div>bar</div>' }
            const NotFoundComponent = { template: '<div>404 - No encontrado</div>' }
            /* ROUTES */
            const routes = [
                { path: '/user-locations/:id', component: UserLocations, props: true },
                { path: '/user-modules/:id', component: UserModules, props: true },
                { path: '/users', component: Users },
                { path: '/', component: Users },
                { path: '/foo', component: Foo },
                { path: '/bar', component: Bar },
                { path: '*', component: NotFoundComponent },
            ]
            const router = new VueRouter({
                mode: 'history',
                routes
            })
            /* ROOT */
            const LabApp  = new Vue({
                el: '#app',
                router,
                components: {
                    'app': App,
                }
            })
        </script>
    </body>
</html>
