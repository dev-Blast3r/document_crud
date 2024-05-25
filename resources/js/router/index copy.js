// resources/js/router/index.js
import Vue from 'vue';
import VueRouter from 'vue-router';
import Documentos from '../components/Documentos.vue';
import CrearDocumento from '../components/CrearDocumento.vue';
import EditarDocumento from '../components/EditarDocumento.vue';
import Login from '../components/Login.vue';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: Documentos },
    { path: '/documentos/crear', component: CrearDocumento },
    { path: '/documentos/:id/editar', component: EditarDocumento },
    { path: '/login', component: Login },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

export default router;
