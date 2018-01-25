import 'vue';

import { storiesOf } from '@storybook/vue';
import MyButton from './Button.vue';

storiesOf('Button', module)
    .add('story as a component', () => ({
        components: { MyButton },
        template: '<my-button :rounded="true">rounded</my-button>'
    }))
    .add('with text', () => ({
        components: { MyButton },
        template: '<div><my-button>Hello Button</my-button><div>😀 😎 👍 💯</div></div>'
    }));
