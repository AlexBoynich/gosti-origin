<template>
    <div id="delivery">       
         <deliveryBlock/>
    </div>
</template>

<script>
import deliveryBlock from "@/components/deliveryBlock/deliveryBlock.vue";

export default {
    name: "catalogView",
    data() {
        return {

        }
    },
    components: {
        deliveryBlock
    },

}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global";
</style>
