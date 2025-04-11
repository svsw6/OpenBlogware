import template from './sw-cms-el-config-blog-detail.html.twig';
import './sw-cms-el-config-blog-detail.scss';

const { Mixin } = Shopware;

export default {
    template,

    inject: ['repositoryFactory'],

    mixins: [
        Mixin.getByName('cms-element'),
    ],

    created() {
        this.createdComponent();
    },

    methods: {
        createdComponent() {
            this.initElementConfig('blog');
        },
    },
};
