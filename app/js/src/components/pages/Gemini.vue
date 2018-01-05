<template>
    <div data-gemini-container>
        <test-component/>
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
        name: 'gemini',
        store,
        components: {
            UserSelect,
            'test-component': UserSelect,
        },
    };
</script>

<style scoped>
</style>
