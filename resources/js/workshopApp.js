require('./bootstrap'); // this is not the boostrap plugin

import Vue from 'vue';
import VModal from 'vue-js-modal'
import VueSelect from 'vue-cool-select'

import draggable from 'vuedraggable'
Vue.component('draggable', draggable);

import VueRouter from 'vue-router'
Vue.use(VueRouter)

// https://github.com/keen-on-design/vue-flash-message
import VueFlashMessage from 'vue-flash-message';
Vue.use(VueFlashMessage);
require('vue-flash-message/dist/vue-flash-message.min.css'); // too replace later

//broadcaster laravel
// import Echo from "laravel-echo"

// window.io = require('socket.io-client');

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001',
//     key: '0e0611c3c657918415d71bdcc1088299',
// });

// window.Echo.channel('messages-demo').listen('MessagePushed', (e) => {
//     console.log(e);
// })

Vue.use(require('vue-moment'));

Vue.component('workshop-entry', require('./components/WorkshopEntry.vue'));
Vue.component('axios-input', require('./components/AxiosInput.vue'));
Vue.component('workshop-input', require('./components/workshop/WorkshopInput.vue'));
Vue.component('date-picker-input', require('./components/workshop/DatePickerInput.vue'));

import test from './components/workshop/test.vue';
import test2 from './components/workshop/test2.vue';
 
Vue.use(VModal)

Vue.use(VueSelect, {
  theme: 'bootstrap' // or 'material-design'
})

Vue.mixin({
    methods: {
    	autoInputReset: function(target){
            target.classList.remove('saved-success');
            target.classList.remove('saved-failed');
            target.classList.add('saving');
    	},
    	autoInputSuccess: function(target){
            target.classList.remove('saving');
            target.classList.add('saved-success');
    	},
    	autoInputFailed: function(target){
            target.classList.remove('saving');
            target.classList.add('saved-failed');
    	}
    }
})

//     ____              __
//    / __ \____  __  __/ /____  _____
//   / /_/ / __ \/ / / / __/ _ \/ ___/
//  / _, _/ /_/ / /_/ / /_/  __(__  )
// /_/ |_|\____/\__,_/\__/\___/____/

const routes = [
  { path: '/', component: test },
  { path: '/test2', component: test2 },
  { path: '*', redirect: '/' }
]

const router = new VueRouter({
    base: '/workshops/' + document.getElementById('workshop-id').textContent, 
    // mode: 'history',
    routes: routes // short for `routes: routes`
})

const app = new Vue({
    router: router,
    el: '#app',
    methods: {
    	toogleMobileNav: function(){
    		document.getElementsByClassName("mobile-nav")[0].classList.toggle('invisible');
    	}
    }
});
