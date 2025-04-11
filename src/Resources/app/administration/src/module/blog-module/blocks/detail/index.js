const { Component } = Shopware;

Component.register('sw-cms-block-blog-detail', () => import('./component'));
Component.register('werkl-cms-preview-blog-detail', () => import('./preview'));

Shopware.Service('cmsService').registerCmsBlock({
    name: 'blog-detail',
    label: 'werkl-blog.blocks.blog.detail.label',
    category: 'werkl-blog',
    component: 'werkl-cms-block-blog-detail',
    previewComponent: 'werkl-cms-preview-blog-detail',
    defaultConfig: {
        marginBottom: '0px',
        marginTop: '0px',
        marginLeft: '0px',
        marginRight: '0px',
        sizingMode: 'boxed',
    },
    slots: {
        blogDetail: 'blog-detail',
    },
});
