import template from './werkl-blog-category-tree.html.twig';

export default {
    template,

    emits: ['change-category-id'],

    data() {
        return {
            blogCategory: null,
            translationContext: 'werkl-blog-category',
        };
    },

    computed: {
        categoryRepository() {
            return this.repositoryFactory.create('werkl_blog_category');
        },

        category() {
            return this.blogCategory;
        },
    },

    methods: {
        changeCategory(category) {
            this.$emit('change-category-id', category.id);
        },

        syncProducts() {},
    },
};
