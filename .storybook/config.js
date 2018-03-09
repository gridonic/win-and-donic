import { addDecorator, configure } from '@storybook/vue';

// automatically import all files ending in *.stories.js
const req = require.context('../app/js/stories', true, /.stories.js$/);

function loadStories() {
    req.keys()
        .forEach((filename) => req(filename));
}

addDecorator(() => {
    return {
        template: `<div :style="style" data-storybook-container><story/></div>`,
        data: () => {
            return {
                style: {
                    display: 'inline-block',
                    padding: '5pt'
                }
            };
        }
    };
});

configure(loadStories, module);
