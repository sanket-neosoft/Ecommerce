import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem('user')),
        cart: JSON.parse(localStorage.getItem('cart')),
    },
    getters: {
        cart: state => state.cart,
        user: state => state.user,
    },
    actions: {
        user(context, payload) {
            context.commit('setUser', payload);
        },
        addToCart(context, payload) {
            context.commit('setCart', payload);
        }
    },
    mutations: {
        setUser(state, payload) {
            return state.user = payload;
        },
        setCart(state, payload) {
            return state.cart = payload;
        }
    },
});