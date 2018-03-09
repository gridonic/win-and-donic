<template>
    <div class="gemini" data-gemini-container>
        <test-component/>
    </div>
</template>

<script>
import Vue from 'vue';
import Vuex from 'vuex';
import UserSelect from '@/components/controls/UserSelect';
import User from '@/entity/User';

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

Vue.use(Vuex);

const StoreMock = class DashboardStore {
    get state() {
        return {
            players: [
                new User({ id: 1, username: 'dennis' }),
                new User({ id: 2, username: 'julez' }),
                new User({ id: 3, username: 'peschee' })
            ]
        };
    }

    get getters() {
        return {
            players: state => state.players
        };
    }
};

const storeMock = new StoreMock();

const store = new Vuex.Store({
    modules: {
        storeMock
    }
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
