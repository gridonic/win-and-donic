<template>
    <div class="gemini" data-gemini-container>
        <test-component/>
    </div>
</template>

<script>
import Vue from 'vue';
import Vuex from 'vuex';
import UserSelect from '@/components/controls/UserSelect';
import DashboardStore from '@/store/DashboardStore';

// const file = 'UserSelect';
// // eslint-disable-next-line
// const x = require(`../controls/${file}`);
// console.log(x);

// var normalizedPath = require("path").join(__dirname, "routes");
//
// require("fs").readdirSync(normalizedPath).forEach(function(file) {
//     require("./routes/" + file);
// });

Vue.use(Vuex);

const store = new Vuex.Store({
    state: new DashboardStore()
});

export default {
    name: 'Gemini',
    store,
    components: {
        UserSelect,
        'test-component': UserSelect
    }
};
</script>

<style scoped>
    .gemini {
        display: inline-block;
    }
</style>
