import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/home/HomeView.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        meta: {
            title: 'Гости',
            description: 'Городское кафе для завтраков, ланчей, ужинов с бокалом вина'
        },
        component: HomeView,
    },
    {
        path: '/catalog',
        name: 'catalog',
        meta: {
            title: 'Гости • Каталог',
            description: 'Заказать любимые блюда домой',
        },
        component: () => import( '../views/catalog/catalogView.vue')
    },
    {
        path: '/catering',
        name: 'catering',
        meta: {
            title: 'Гости • Кейтеринг',
            description: 'Меню кейтеринга для вашего праздника или мероприятия',
        },
        component: () => import( '../views/catering/cateringView.vue')
    },
    {
        path: '/cart',
        name: 'cart',
        meta: {
            title: 'Гости • Корзина',
            description: 'Доставка и самовывоз любимых блюд'
        },
        component: () => import( '../views/cart/cartView.vue')
    },
    {
        path: '*',
        name: '404',
        meta: {
            title: 'Гости • 404',
            description: 'Страница не найдена'
        },
        component: () => import( '../views/404/PageNotFound.vue')
    },
]
const router = new VueRouter({
    mode: 'history',
    scrollBehavior(to,){
        if (to.hash) {
            return {selector: to.hash}
        }
         return {
            x:0,
            y: 0
         }
    },
    base: process.env.BASE_URL,
    routes
})
router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    document.querySelector('meta[name="description"]').setAttribute('content', to.meta.description);
    next();
})

export default router
