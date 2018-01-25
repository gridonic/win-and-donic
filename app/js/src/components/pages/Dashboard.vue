<template>
    <div class="page">
        <h1>{{ title }}</h1>
        <user-select v-model="selectedHomePlayer"/>
        <user-select v-model="selectedAwayPlayer"/>
        <div>Home: {{ selectedHomePlayer ? selectedHomePlayer.username : null }}</div>
        <div>Away: {{ selectedAwayPlayer ? selectedAwayPlayer.username : null }}</div>
    </div>
</template>

<script>
import Vue from 'vue';
import Vuex from 'vuex';
import UserSelect from '@/components/controls/UserSelect';
import DashboardStore, { Actions } from '@/store/DashboardStore';
import Container from '@/service/Container';

Vue.use(Vuex);

const container = new Container();

const dashboardStore = new DashboardStore({
    userLoaderService: container.userLoaderService
});

const store = new Vuex.Store({
    modules: {
        dashboardStore
    }
});

store.dispatch(Actions.LOAD_PLAYERS);

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
