import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        players: ['bidu', 'julez', 'peschee', 'fourth'],
    },
    getters: {
        nonzero: state => state.players.length > 0,
    },
});
