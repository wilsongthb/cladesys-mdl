
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>INSTRUMENTAL</title>

        <link rel="stylesheet" href="{{asset('bower_components/roboto-fontface/css/roboto-condensed/roboto-condensed-fontface.css')}} ">
        <link rel="stylesheet" href="{{asset('bower_components/material-design-icons-dist/material-icons.css')}} ">
        <link rel="stylesheet" href="{{asset('bower_components/material-design-lite/material.css')}} ">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="app">
            <h1>Hello App!</h1>
            <p>
                <!-- Utiliza el componente router-link para la navegación. -->
                <!-- especifica el enlace pasando la propiedad `to`. -->
                <!-- <router-link> será renderizado por defecto como una etiqueta `<a>` -->
                <router-link to="/foo">Go to Foo</router-link>
                <router-link to="/bar">Go to Bar</router-link>
            </p>
            <!-- El componente que coincida con la ruta será renderizado aquí -->
            <router-view></router-view>
        </div>

        <script src="{{asset('bower_components/material-design-lite/material.js')}} "></script>
        <script src="{{asset('bower_components/vue/dist/vue.js')}}  "></script>
        <script src="{{asset('bower_components/vue-resource/dist/vue-resource.min.js')}} "></script>
        <script src="{{asset('bower_components/vue-router/dist/vue-router.min.js')}} "></script>

        <!-- templates -->

        @include('lab.vue.LinksNavigation')
        @include('lab.vue.PageContent')
        @include('lab.vue.TopMenu')

        <!-- Root Component -->
        @include('lab.vue.App')

        <script>
            /* CONFIGURATION */
            const LabAppConfig = {
                appUrl: '{{url('/lab')}}'
            }
            /* ROOT */
            Vue.use(VueResource)
            Vue.use(VueRouter)

            const Foo = { template: '<div>foo</div>' }
            const Bar = { template: '<div>bar</div>' }
            const routes = [
                { path: '/foo', component: Foo },
                { path: '/bar', component: Bar }
            ]
            const router = new VueRouter({
                routes // forma corta para routes: routes
            })
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
