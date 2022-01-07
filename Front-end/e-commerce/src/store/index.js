import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem('user')),
    },
    actions: {
        user(context, payload) {
            context.commit('setUser', payload);
        }
    },
    mutations: {
       setUser(state, payload) {
           return state.user = payload.user;
       }
    },
});