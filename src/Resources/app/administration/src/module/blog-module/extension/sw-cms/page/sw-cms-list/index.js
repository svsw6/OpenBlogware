export default {
    computed: {
        sortPageTypes() {
            const sortPageTypes = this.$super('sortPageTypes');

            sortPageTypes.push({
                value: 'blog_detail',
                name: this.$tc('sw-cms.sorting.labelSortByBlogPages'),
            });

            return sortPageTypes;
        },
    },
};
