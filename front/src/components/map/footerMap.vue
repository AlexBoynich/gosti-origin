<template>
    <div id="map" style="width: 644px; height: 427px"></div>
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

<style scoped>
    #map {
        border-radius: 16px;
        overflow: hidden;
    }

</style>
