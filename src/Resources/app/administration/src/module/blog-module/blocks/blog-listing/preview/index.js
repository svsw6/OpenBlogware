import template from './werkl-cms-preview-blog-listing.html.twig';
import './werkl-cms-preview-blog-listing.scss';

export default {
    template,

    computed: {
        today() {
            return new Date().toLocaleDateString();
        },
    },
};
