// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Login from './components/Login.vue';
import CrearDocumento from './components/CrearDocumento.vue';
import EditarDocumento from './components/EditarDocumento.vue';

const routes = [
    { path: '/', component: Home, meta: { requiresAuth: true } },
    { path: '/login', component: Login },
    { path: '/crear', component: CrearDocumento, name: 'crearDocumento' },
    { path: '/:id/editar', component: EditarDocumento, name: 'editarDocumento' },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!localStorage.getItem('token')) {
            next('/login');
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
