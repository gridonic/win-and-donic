import Vue from 'vue';
import UserSelect from '@/components/controls/UserSelect';

describe('UserSelect.vue', () => {
    it('should contain correct elements', () => {
        const Constructor = Vue.extend(UserSelect);
        const vm = new Constructor().$mount();
        expect(vm.$el.querySelector('.hello h1').textContent).toEqual('Welcome to Your Vue.js App');
    });
});
