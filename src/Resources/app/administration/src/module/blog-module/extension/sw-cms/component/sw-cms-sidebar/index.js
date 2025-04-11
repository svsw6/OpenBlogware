import template from './sw-cms-sidebar.html.twig';
import BLOG from '../../../../constant/open-blogware.constant';

export default {
    template,

    computed: {
        isBlogDetail() {
            return this.page.type === BLOG.PAGE_TYPES.BLOG_DETAIL;
        },
    },
};
