import Vue from 'vue';
import Vuex from 'vuex';

import { storiesOf } from '@storybook/vue';

import User from '@/entity/User';

import UserSelect from '../src/components/controls/UserSelect';

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

storiesOf('Components/UserSelect', module)
    .add('Default', () => ({
        components: { UserSelect },
        template: '<user-select :rounded="true">rounded</user-select>',
        store
    }));
