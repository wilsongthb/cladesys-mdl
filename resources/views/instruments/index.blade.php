
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$appName}}</title>

        <link rel="stylesheet" href="{{asset('bower_components/roboto-fontface/css/roboto-condensed/roboto-condensed-fontface.css')}} ">
        <link rel="stylesheet" href="{{asset('bower_components/material-design-icons-dist/material-icons.css')}} ">
        <link rel="stylesheet" href="{{asset('bower_components/material-design-lite/material.css')}} ">
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

        <script src="{{asset('bower_components/material-design-lite/material.js')}} "></script>
        <script src="{{asset('bower_components/vue/dist/vue.js')}}  "></script>
        <script src="{{asset('bower_components/vue-resource/dist/vue-resource.min.js')}} "></script>
        <script src="{{asset('bower_components/vue-router/dist/vue-router.min.js')}} "></script>

        <base href="{{$baseUrl}}">
        <!-- templates -->
        @include('instruments.vue.DoctorsCreateComponent')
        @include('instruments.vue.DoctorsComponent')
        @include('instruments.vue.LinksNavigation')
        @include('instruments.vue.PageContent')
        @include('instruments.vue.TopMenu')

        <!-- Root Component -->
        @include('instruments.vue.App')

        <script>
            /* GLOBAL CONFIG*/
            Vue.use(VueResource)
            Vue.use(VueRouter)
            Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}'
            /* CONFIGURATION */
            const LabAppConfig = {
                appUrl: "{{$appUrl}}",
                apiUrl: "{{$apiUrl}}",
            }

            const Foo = { template: '<div>foo</div>' }
            const Bar = { template: '<div>bar</div>' }
            const NotFoundComponent = { template: '<div>404 - No encontrado</div>' }

            /* ROUTES */
            const routes = [
                { path: '/', component: Foo },
                { path: '/foo', component: Foo },
                { path: '/bar', component: Bar },
                { path: '*', component: NotFoundComponent },
                { path: '/doctors', component: DoctorsComponent },
                { path: '/doctors/create', component: DoctorsCreateComponent },
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
                    'app': App
                }
            })
        </script>
    </body>
</html>
