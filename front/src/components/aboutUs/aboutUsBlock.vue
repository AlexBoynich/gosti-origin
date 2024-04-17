<template>
    <section v-if="oneSlide" class="about-us-block">
        <div class="container">
            <SliderWrapper :slides="aboutUsSlides" class="slider"/>
            <img src="/images/homePage/aboutUs/about-us-block-background.png" alt="about-us-block-decor"
                 class="about-us-decor">
        </div>
    </section>
</template>

<script>
import SliderWrapper from "@/components/aboutUs/sliderWrapper.vue";

export default {
    name: "aboutUsBlock",
    data () {
        return {
            aboutUsSlides: [
                {
                    img: "/images/homePage/aboutUs/main-slide.png",
                    title: "Мы — Гости",
                    desc: "<p>Наше городское кафе на каждый день для любимых завтраков, ланчей, ужинов с бокалом вина в уютной атмосфере!</p><p>Еда для нас не только про многогранность вкусов, но и про вдохновение, теплые эмоции и общение, которое мы разделяем вместе с вами!</p>"
                },
                {
                    img: "/images/homePage/aboutUs/small-hall.png",
                    title: "Малая зона",
                    desc: "<p>Зал рассчитан на 20-28 человек.</p><p>В зале имеется гардеробная комната, спуск в VIP — комнату, зона Welcome/Candy — бара, для игр, фото-зона и детская зона.</p><p>Подходит для проведения церемонии регистрации.</p>"
                },
                {
                    img: "/images/homePage/aboutUs/main-hall.png",
                    title: "Основной зал",
                    desc: "<p>Зал рассчитан на 50-55 человек.</p><p>На территории основного зала находится барная зона. Можно использовать для рассадки гостей или фуршетной планировки. Часть зала может быть использована под выступление группы или под фотозону.</p>"
                },
                {
                    img: "/images/homePage/aboutUs/vip.png",
                    title: "VIP — зона",
                    desc: "<p>Зал рассчитан на 15 человек.</p><p>В зале имеется телевизор, гардероб, кондиционер. За VIP - зоной закреплен отедльный официант.</p><p>Подходит для камерных свадеб. Можно использовать зону для:детского отдыха (мультфильмы, сон), комната отдыха для команды или как гримерную.</p>"
                },
                {
                    img: "/images/homePage/aboutUs/summer-terrace.png",
                    title: "Летняя веранда",
                    desc: "<p>Зал рассчитан на 20-28 человек.</p><p>На веранде имеются Welcome зона и фото-зона.</p><p>Подходит для проведения церемонии регистрации.</p>"
                }
            ]
        }
    },
    components: {
        SliderWrapper
    },
    computed: {
        oneSlide: function () {
            return this.aboutUsSlides.length
        },
    }
}
</script>

<style scoped lang="scss">
@import "src/assets/styles/global";

.about-us-block {
    padding: 96px 0;
    background: rgba(123, 149, 97, 0.52);
    position: relative;

    @include mobile {
        padding: 60px 0;
    }

    .slider {
        z-index: 2;
    }

    .about-us-decor {
        position: absolute;
        left: -100px;
        bottom: -44px;
        width: 810px;
        height: 408px;
        @include mobile {
            width: 100%;
            height: auto;
            bottom: 0;
            left: 0;
        }
    }
}
</style>
