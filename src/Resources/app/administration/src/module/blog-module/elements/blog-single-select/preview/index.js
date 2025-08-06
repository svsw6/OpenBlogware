import template from './werkl-cms-el-preview-blog-single-select.html.twig';
import './werkl-cms-el-preview-blog-single-select.scss';

const { Filter } = Shopware;

export default {
    template,

    computed: {
        assetFilter() {
            return Filter.getByName('asset');
        },
    },
};
