import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem('user')),
        cart: JSON.parse(localStorage.getItem('cart')),
        wishlist: JSON.parse(localStorage.getItem('wishlist')),
    },
    getters: {
        cart: state => state.cart,
        user: state => state.user,
        wishlist: state => state.wishlist
    },
    actions: {
        user(context, payload) {
            context.commit('setUser', payload);
        },
        addToCart(context, payload) {
            context.commit('setCart', payload);
        },
        addToWishlist(context, payload) {
            context.commit('setWishlist', payload);
        }
    },
    mutations: {
        setUser(state, payload) {
            return state.user = payload;
        },
        setCart(state, payload) {
            return state.cart = payload;
        },
        setWishlist(state, payload) {
            return state.wishlist = payload;
        }
    },
});