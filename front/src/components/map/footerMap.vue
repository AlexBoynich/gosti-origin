<template>
    <div id="map" ></div>
</template>

<script>
export default {
    name: "footerMap",
    methods: {
        init() {
            let ymaps = window.ymaps;
            ymaps.ready(function () {        
                let map = new ymaps.Map("map", {
                    center: [56.476493, 84.969236],            
                    zoom: 17,
                });        
                let mark = new ymaps.Placemark(
                    [56.476493, 84.969236],
                    {},
                    {iconColor: '#7B9561'}
                )
                map.geoObjects.add(mark);
            });
        }
    },
    created() {
        this.init()
    }
}
</script>

<style scoped lang="scss">
@import'/src/assets/styles/global.scss';
    #map {
        border-radius: 16px;
        overflow: hidden;
        width: 628px;
        height: 427px;
        @media (max-width: 800px) {
            width: 100%;
            height: auto;
            aspect-ratio: 328/258;
            border-radius: 7px;
        }
    }

</style>
