<template id="app-template">
    <div>
        <top-menu></top-menu>
        <!-- <Instruments-Component></Instruments-Component> -->
    </div>
</template>
<script>
const App = {
    components: {
        'top-menu': TopMenu,
        'instruments-component': InstrumentsComponent
    },
    template: '#app-template'
}
</script>