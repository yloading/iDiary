import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import blogPage from './components/pages/Blog.vue'
import profilePage from './components/pages/Profile.vue'
import homePage from './components/pages/Home.vue'
import aboutPage from './components/pages/About.vue'
import addPost from './components/pages/AddPost.vue'
import settings from './components/pages/Settings.vue'
import login from './components/login/Login.vue'
import signup from './components/login/SignUp.vue'
// import deleteModal from './components/common/deleteModal.vue'


const routes = [

    // {
    //     path: '/test',
    //     component: deleteModal
    // },

    {
        path: '/',
        component: homePage
    },

    {
        path: '/blog',
        component: blogPage
    },

    {
        path: '/profile',
        component: profilePage
    },

    {
        path: '/about',
        component: aboutPage
    },

    {
        path: '/create-blog',
        component: addPost
    },

    
    {
        path: '/settings',
        component: settings
    },

    {
        path: '/login',
        component: login
    },

    {
        path: '/sign-up',
        component: signup
    }
    
]

export default new Router({
    mode: 'history',
    routes
})