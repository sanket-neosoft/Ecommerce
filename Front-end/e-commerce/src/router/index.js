import Vue from 'vue';
import Router from 'vue-router';
import Contact from '../components/Contact.vue';
import Login from '../components/Login.vue';
import Checkout from '../components/Checkout.vue';
import Cart from '../components/Cart.vue';
import Home from '../components/Home.vue';
import Category from '../components/Category.vue';
import ProductDetails from '../components/ProductDetails.vue';
import Account from '../components/Account.vue';
import Wishlist from '../components/Wishlist.vue';
import Order from '../components/Order.vue';
import Track from '../components/Track.vue';

Vue.use(Router);

export default new Router({
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    mode: 'history',
    routes: [{
        path: '/',
        name: 'Home',
        component: Home
    }, {
        path: '/contact',
        name: 'Contact',
        component: Contact
    }, {
        path: '/login',
        name: 'Login',
        component: Login
    }, {
        path: '/checkout',
        name: 'Checkout',
        component: Checkout,
    }, {
        path: '/cart',
        name: 'Cart',
        component: Cart
    }, {
        path: '/category/:id',
        name: 'Category',
        component: Category,
    }, {
        path: '/product/:id',
        name: 'ProductDetails',
        component: ProductDetails,
    }, {
        path: '/account',
        name: 'Account',
        component: Account
    }, {
        path: '/wishlist',
        name: 'Wishlist',
        component: Wishlist
    }, {
        path: '/myorders',
        name: 'Order',
        component: Order
    }, {
        path:'/trackorders',
        name:'Track',
        component: Track
    }]
});