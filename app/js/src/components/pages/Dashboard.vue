<template>
    <div class="page">
        <h1>{{ title }}</h1>
        <user-select v-model="selectedHomePlayer"/>
        <user-select v-model="selectedAwayPlayer"/>
        <div>Home: {{ selectedHomePlayer ? selectedHomePlayer.username : null }}</div>
        <div>Home: {{ selectedAwayPlayer ? selectedAwayPlayer.username : null }}</div>
    </div>
</template>

<script>
import Vue from 'vue';
import Vuex from 'vuex';
import UserSelect from '@/components/controls/UserSelect';
// import DashboardStore from '@/store/DashboardStore';
import Container from '@/service/Container';

Vue.use(Vuex);

const container = new Container();

// const store = new Vuex.Store({
//     state: new DashboardStore({
//         userLoaderService: container.userLoaderService,
//     }),
//     mutations: {
//         async loadPlayers(state) {
//             // eslint-disable-next-line
//             state.players = await state.loadPlayers();
//             console.log(state.players);
//         },
//     },
// });

const store = new Vuex.Store({
    state: {
        players: []
    },
    mutations: {
        updatePlayers(state, players) {
            // eslint-disable-next-line
            state.players = players;
        }
    },
    actions: {
        async loadPlayers({ commit }) {
            commit('updatePlayers', await container.userLoaderService.loadAllUsersAsync());
        }
    }
});

store.dispatch('loadPlayers');

export default {
    name: 'Dashboard',
    store,
    data() {
        return {
            title: 'Welcome to Win & Donic!',
            selectedHomePlayer: null,
            selectedAwayPlayer: null
        };
    },
    components: {
        UserSelect,
        'user-select': UserSelect
    }
};
</script>

<style scoped>
</style>
