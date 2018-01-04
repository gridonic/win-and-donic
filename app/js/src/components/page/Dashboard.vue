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
    import UserSelect from '../controls/UserSelect';
    import dashboardStore from '../store/dashboardStore';

    export default {
        name: 'dashboard',
        store: dashboardStore,
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
