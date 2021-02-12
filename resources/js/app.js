require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './components/App.vue'
import Login from './components/Login.vue'
import Dashboard from './components/Dashboard.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: Login
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        }
    ]
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('bridgenote_token')


    if (to.name !== 'login' && !token) {
        next({ name: 'login' })
    }
    else next()

    /*const token = localStorage.getItem('bridgenote_token') == null;

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (token) {
            next({
                name: 'login',
                query: { redirect: to.fullPath }
            })
        }
        else {
            next()
        }
    }*/
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
})