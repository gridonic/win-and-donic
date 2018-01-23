import Vue from 'vue';
import Dashboard from '@/components/pages/Dashboard';

describe('HelloWorld.vue', () => {
    it('should render correct contents', () => {
        const Constructor = Vue.extend(Dashboard);
        const vm = new Constructor().$mount();

        expect(vm.$el.querySelector('h1').textContent)
            .toEqual('Welcome to Win & Donic!');
    });
});
