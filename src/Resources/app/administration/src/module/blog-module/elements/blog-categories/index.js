import './component';
import './config';
import './preview';

Shopware.Service('cmsService').registerCmsElement({
    name: 'blog-categories',
    label: 'Blog Categories',
    component: 'sw-cms-el-categories',
    configComponent: 'sw-cms-el-config-categories',
    previewComponent: 'sw-cms-el-preview-categories',
    defaultConfig: {
    },
});
