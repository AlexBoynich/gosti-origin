<template>
 <div class="container">
    <CateringBlock />
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
    min-height: 100vh;
    padding-top: 174px;
}
</style>
