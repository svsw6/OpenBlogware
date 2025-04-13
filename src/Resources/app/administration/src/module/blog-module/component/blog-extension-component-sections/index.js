import template from './blog-extension-component-sections.html.twig';

const { State } = Shopware;

export default {
    template,

    props: {
        positionIdentifier: {
            type: String,
            required: true,
        },
    },

    computed: {
        componentSections() {
            return State.get('extensionComponentSections').identifier[this.positionIdentifier] ?? [];
        },
    },
};
