import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/home/HomeView.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Гости',
        component: HomeView,
    },
    {
        path: '/catalog',
        name: 'Гости • Каталог',
        component: () => import( '../views/catalog/catalogView.vue')
    },
    {
        path: '/catering',
        name: 'Гости • Кейтеринг',
        component: () => import( '../views/catering/cateringView.vue')
    },
    {
        path: '/cart',
        name: 'Гости • Корзина',
        component: () => import( '../views/cart/cartView.vue')
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})
router.beforeEach((to, from, next) => {
    document.title = to.name;
    next();
})

export default router
