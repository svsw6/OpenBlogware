import template from './sw-cms-el-blog.html.twig';
import './sw-cms-el-blog.scss';

const { Mixin } = Shopware;

export default {
    template,

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
