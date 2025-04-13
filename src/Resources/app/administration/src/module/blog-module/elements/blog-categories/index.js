const { Component } = Shopware;

Component.register('sw-cms-el-categories', () => import('./component'));
Component.register('sw-cms-el-config-categories', () => import('./config'));
Component.register('sw-cms-el-preview-categories', () => import('./preview'));

Shopware.Service('cmsService').registerCmsElement({
    name: 'blog-categories',
    label: 'Blog Categories',
    component: 'sw-cms-el-categories',
    configComponent: 'sw-cms-el-config-categories',
    previewComponent: 'sw-cms-el-preview-categories',
    defaultConfig: {
    },
});
