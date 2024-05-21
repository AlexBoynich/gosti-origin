<template>
    <div class="container">
        <CateringBlock/>
    </div>
</template>

<script>


import CateringBlock from "../../components/catering/cateringBlock";

export default {
    name: "cateringView",
    components: {
        CateringBlock
    },
}
</script>

<style scoped lang="scss">
@import "@/assets/styles/global.scss";

.container {
    margin-top: 174px;
    @include mobile {
        margin-top: 100px;
        padding-bottom: 90px;
        padding-top: 0;
    }
}
</style>
