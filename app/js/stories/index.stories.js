import 'vue';

import { storiesOf } from '@storybook/vue';
import Button from './Button.vue';

storiesOf('Button', module)
    .add('story as a component', () => ({
        components: { Button },
        // template: '<button :rounded="true">rounded</button>'
    }))
    .add('with text', () => ({
        components: { Button },
        // template: '<button onClick={action(\'clicked\')}>Hello Button</button>'
    }))
    .add('with some emoji', () => ({
        components: { Button },
        // template: '<button onClick={action(\'clicked\')}>😀 😎 👍 💯</button>'
    }));
