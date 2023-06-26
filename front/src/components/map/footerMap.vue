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
                new ymaps.Map("map", {
                    center: [56.476587, 84.969568],
                    zoom: 17,
                });
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
