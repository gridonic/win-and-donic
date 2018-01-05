import Vue from 'vue';
import Dashboard from '@/components/pages/Dashboard';

describe('Dashboard.vue', () => {
    it('should render correct contents', () => {
        expect(1).to.be.a('number');
    });

    it('should something', () => {
        const Constructor = Vue.extend(Dashboard);
        const vm = new Constructor().$mount();
        expect(vm.$el.querySelector('h1').textContent).to.be.equal('Welcome to Win & Donic!');
    });
});
