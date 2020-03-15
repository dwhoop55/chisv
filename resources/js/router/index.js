import Vue from 'vue'
import VueRouter from 'vue-router';
import conferences from '../store/modules/conferences';

Vue.use(VueRouter);

const routes = [
    { path: '/conferences', component: conferences },
];

const router = new VueRouter({
    routes
});

export default router