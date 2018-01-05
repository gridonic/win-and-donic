<template>
    <div class="page">
        <h1>{{ title }}</h1>
        <user-select v-model="selectedHomePlayer"/>
        <user-select v-model="selectedAwayPlayer"/>
        <div>Home: {{ selectedHomePlayer }}</div>
        <div>Home: {{ selectedAwayPlayer }}</div>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Vuex from 'vuex';
    import UserSelect from '@/components/controls/UserSelect';
    import DashboardStore from '@/store/DashboardStore';

    Vue.use(Vuex);

    const store = new Vuex.Store({
        state: new DashboardStore(),
    });

    export default {
        name: 'dashboard',
        store,
        data() {
            return {
                title: 'Welcome to Win & Donic!',
                selectedHomePlayer: 'bidu',
                selectedAwayPlayer: 'julez',
            };
        },
        components: {
            UserSelect,
            'user-select': UserSelect,
        },
    };
</script>

<style scoped>
</style>
