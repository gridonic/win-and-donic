import Vue from 'vue';
import Gemini from '@/components/pages/Gemini';
// import router from '@/router';

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
    el: '#app',
    template: '<gemini-app/>',
    data: {
        message: 'Hello Vue!'
    },
    components: {
        'gemini-app': Gemini
    }
});
