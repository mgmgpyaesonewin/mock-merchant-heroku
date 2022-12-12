import Vue from 'vue';
import VueRouter from 'vue-router@3';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
    ]
});

export default router;
