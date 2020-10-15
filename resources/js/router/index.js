import Vue from 'vue'
import VueRouter from 'vue-router';
import store from '@/store';

import conferences from '@/views/conference/Conferences';
import conference from '@/views/conference/Conference';
import userEdit from '@/views/user/UserEdit';
import userIndex from '@/views/user/UserIndex';
import jobIndex from '@/views/job/JobIndex';
import calendar from '@/views/calendar/Calendar';
import faq from '@/views/faq/Faq';

Vue.use(VueRouter);

const routes = [
    {
        path: '',
        redirect: { name: 'conferences' }
    },
    {
        name: 'conferences',
        meta: { title: 'Conferences', auth: true },
        path: '/conference',
        component: conferences
    },
    {
        name: 'conference',
        meta: { auth: true },
        path: '/conference/:key',
        component: conference
    },
    {
        name: 'users',
        meta: { title: 'Users', auth: true },
        path: '/user',
        component: userIndex
    },
    {
        name: 'user',
        meta: { title: 'User', auth: true },
        path: '/user/:id/edit',
        component: userEdit
    },
    {
        name: 'jobs',
        meta: { title: 'Jobs', auth: true },
        path: '/job', component: jobIndex
    },
    {
        name: 'calendar',
        meta: { title: 'Calendar', auth: true },
        path: '/calendar', component: calendar
    },
    {
        name: 'faq',
        meta: { title: 'FAQ', auth: true },
        path: '/faq/:id?', component: faq
    },

    // Auth routes
    {
        name: 'login',
        meta: { title: 'Login', layout: 'no-nav' },
        path: '/login',
        component: () => import("@/views/auth/Login.vue")
    },
    {
        name: 'register',
        meta: { title: 'Register', layout: 'no-nav' },
        path: '/register',
        component: () => import("@/views/auth/Register.vue")
    },
    {
        name: 'passwordForgot',
        meta: { title: 'Send email to reset password', layout: 'no-nav' },
        path: '/password/forgot',
        component: () => import("@/views/auth/PasswordForgot.vue")
    },
    {
        name: 'passwordReset',
        meta: { title: 'Set new password', layout: 'no-nav' },
        path: '/password/reset/:token',
        component: () => import("@/views/auth/PasswordReset.vue")
    },
    {
        path: '*',
        meta: { title: 'Not Found', layout: 'no-nav' },
        component: () => import("@/views/NotFound.vue")
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach((to, from, next) => {
    if (to.name == "conference") {
        to.meta.title = to.params?.key;
    }

    if (to.meta.title) {
        document.title = to.meta?.title + " - chisv";
    }

    if (!to.meta?.auth && store.getters["auth/user"]) {
        console.log("Logged in, redirecting to overview");
        next('/');
    }

    if (to.meta?.auth && !store.getters["auth/user"]) {
        console.log("Protected route, login first");
        next('/login')
    }


    next();
});

export default router;