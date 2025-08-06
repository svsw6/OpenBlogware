import template from './sw-cms-sidebar.html.twig';
import BLOG from '../../../../constant/open-blogware.constant';

export default {
    template,

    computed: {
        isBlogDetail() {
            return this.page.type === BLOG.PAGE_TYPES.BLOG_DETAIL;
        },

        cmsBlockCategories() {
            const categories = this.$super('cmsBlockCategories');

            if (!this.isBlogDetail) {
                return categories;
            }

            return categories.filter((category) => {
                return category.value !== 'werkl-blog';
            });
        },
    },
};
