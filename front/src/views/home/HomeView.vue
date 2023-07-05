<template>
    <div class="home">
        <mainBlock />
        <aboutUsBlock id="about-us-block"/>
        <deliveryBlock />
    </div>
</template>

<script>

import mainBlock from "@/components/mainBlock/mainBlock.vue";
import aboutUsBlock from "@/components/aboutUs/aboutUsBlock.vue";
import deliveryBlock from "@/components/deliveryBlock/deliveryBlock.vue";

export default {
    name: 'HomeView',
    components: {
        deliveryBlock,
        aboutUsBlock,
        mainBlock
    }
}
</script>
<style scoped lang="scss">
    .about-us-block {
        margin-top: -5px;
    }
</style>
