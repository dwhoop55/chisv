import Vue from 'vue'
import VueRouter from 'vue-router';
import conferences from '@/views/conference/Conferences';
import conference from '@/views/conference/Conference';
import userEdit from '@/views/user/UserEdit';
import userIndex from '@/views/user/UserIndex';
import jobIndex from '@/views/job/JobIndex';
import notFound from '@/views/NotFound';

Vue.use(VueRouter);

const routes = [
    {
        path: '',
        redirect: { name: 'conferences' }
    },
    {
        name: 'conferences',
        meta: { title: 'Conferences' },
        path: '/conference',
        component: conferences
    },
    {
        name: 'conference',
        meta: { title: 'Conference' },
        path: '/conference/:key',
        component: conference
    },
    {
        name: 'users',
        meta: { title: 'Users' },
        path: '/user',
        component: userIndex
    },
    {
        name: 'user',
        meta: { title: 'User' },
        path: '/user/:id/edit',
        component: userEdit
    },
    {
        name: 'jobs',
        meta: { title: 'Jobs' },
        path: '/job', component: jobIndex
    },
    {
        path: '*',
        meta: { title: 'Not Found' },
        component: notFound
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    /* It will change the title when the router is change*/
    if (to.name == "conference") {
        to.meta.title = to.params?.key?.toUpperCase();
    }
    if (to.meta.title) {
        document.title = to.meta?.title + " - chisv";
    }
    next();
});

export default router;