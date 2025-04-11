import template from './werkl-cms-preview-blog-categories.html.twig';
import './werkl-cms-preview-blog-categories.scss';

export default {
    template,

    computed: {
        today() {
            return new Date().toLocaleDateString();
        },
    },
};
