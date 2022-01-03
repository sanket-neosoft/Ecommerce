import Vue from 'vue';
import Router from 'vue-router';
import Contact from '../components/Contact.vue';
import HelloWorld from '../components/HelloWorld.vue';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'HelloWorld',
        component: HelloWorld
    }, {
        path: '/contact',
        name: 'Contact',
        component: Contact
    }]
});