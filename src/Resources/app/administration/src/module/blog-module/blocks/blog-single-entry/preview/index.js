import template from './werkl-cms-preview-blog-single-entry.html.twig';
import './werkl-cms-preview-blog-single-entry.scss';

export default {
    template,

    computed: {
        today() {
            return new Date().toLocaleDateString();
        },
    },
};
