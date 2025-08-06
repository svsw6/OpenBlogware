import template from './werkl-cms-preview-blog-detail.html.twig';
import './werkl-cms-preview-blog-detail.scss';

export default {
    template,

    computed: {
        today() {
            return new Date().toLocaleDateString();
        },
    },
};
