require('./bootstrap');
window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import router from './router'
import store from './store'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import common from './common'
import ReadMore from 'vue-read-more'
 
Vue.use(ReadMore)
Vue.mixin(common)
Vue.use(require('vue-moment'));
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('main-page', require('./components/MainPage.vue').default)


const app = new Vue ({
    el: '#app',
    router,
    store
})