// Layouts
import DefaultLayout from '@/views/layouts/DefaultLayout.vue'
import AuthLayout from '@/views/layouts/AuthLayout.vue'

// Auth
import Login from '@/views/auth/Login.vue'
import Register from '@/views/auth/Register.vue'
import ResetEmail from '@/views/auth/ResetEmail.vue'
import ResetPassword from '@/views/auth/ResetPassword.vue'

// General
import Home from '@/views/Home.vue'

// Errors
import NotFound from '@/views/NotFound.vue'


const routes = () => {

    return [
        {
            path: '/', component: DefaultLayout,
            children: [
                { path: '/', name: 'home', component: Home },
            ]
        },
        {
            path: '/auth', component: AuthLayout,
            children: [
                { path: '/login', name: 'auth.login', component: Login },
                { path: '/password/email', name: 'auth.email', component: ResetEmail },
                { path: '/password/reset/:token', component: ResetPassword, props: true },
                { path: '/register', name: 'landing.register', component: Register }
            ]
        },
        { path: '*', component: NotFound }
    ]
}

export default routes()