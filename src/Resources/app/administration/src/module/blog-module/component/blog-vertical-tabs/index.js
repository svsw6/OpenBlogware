import template from './blog-vertical-tabs.html.twig';

export default {
    template,

    props: {
        defaultItem: {
            type: String,
            default: 'blog',
        },
    },

    methods: {
        onChangeTab(name) {
            this.currentTab = name;
        },
    },
};
