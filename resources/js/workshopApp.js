require('./bootstrap'); // this is not the boostrap plugin

import 'es6-promise/auto'

import Vue from 'vue';
import VModal from 'vue-js-modal'

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
Vue.component('team-manager', require('./components/workshop/TeamManager.vue'));
Vue.component('date-picker-input', require('./components/workshop/DatePickerInput.vue'));
Vue.component('axios-background-image', require('./components/workshop/AxiosBackgroundImage.vue'));

import WorkshopContent from './components/workshop/WorkshopContent.vue';
import Settings from './components/workshop/Settings.vue';
 
Vue.use(VModal)

Vue.mixin({
    computed:{
        isAuthor () {
            return this.$store.getters.isAuthorOfWorkshop
        },
        workshop () {
            return this.$store.getters.workshop
        }
    },
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

import WorkshopStore from './store/workshop/Workshop.js';



//     ____              __
//    / __ \____  __  __/ /____  _____
//   / /_/ / __ \/ / / / __/ _ \/ ___/
//  / _, _/ /_/ / /_/ / /_/  __(__  )
// /_/ |_|\____/\__,_/\__/\___/____/

const routes = [
  { path: '/', component: WorkshopContent, name: 'home' },
  { path: '/Settings', component: Settings, name: 'settings' },
  { path: '*', redirect: '/' }
]

const router = new VueRouter({
    base: '/workshops/' + document.getElementById('workshop-id').textContent, 
    routes: routes, // short for `routes: routes`,
    mode: 'history',
})

const app = new Vue({
    router: router,
    el: '#app',
    methods: {
    	toogleMobileNav: function(){
    		document.getElementsByClassName("mobile-nav")[0].classList.toggle('invisible');
    	},
        toggleSettings: function(){
            if(this.isAuthor){
                if(this.$route.name == 'home'){
                    router.push({ name: 'settings'})
                }
                else{
                    router.go(-1);
                }
            }
            // router.push({ name: 'user', params: { userId: 123 }})

        },
    },
    store: WorkshopStore,
    created: function(){
        this.$store.dispatch('initWorkshop');
    }
});
