const { Component } = Shopware;

Component.register('sw-cms-block-blog-detail', () => import('./component'));
Component.register('werkl-cms-preview-blog-detail', () => import('./preview'));

Shopware.Service('cmsService').registerCmsBlock({
    name: 'blog-detail',
    label: 'werkl-blog.blocks.blogDetail.label',
    category: 'werkl-blog',
    component: 'sw-cms-block-blog-detail',
    previewComponent: 'werkl-cms-preview-blog-detail',
    defaultConfig: {
        marginBottom: null,
        marginTop: null,
        marginLeft: null,
        marginRight: null,
        sizingMode: 'boxed',
    },
    slots: {
        blogDetail: 'blog-detail',
    },
});
