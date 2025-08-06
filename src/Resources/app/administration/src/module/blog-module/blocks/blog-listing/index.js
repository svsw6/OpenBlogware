const { Component } = Shopware;

Component.register('sw-cms-block-blog-listing', () => import('./component'));
Component.register('werkl-cms-preview-blog-listing', () => import('./preview'));

Shopware.Service('cmsService').registerCmsBlock({
    name: 'blog-listing',
    label: 'werkl-blog.blocks.blogListing.label',
    category: 'werkl-blog',
    component: 'sw-cms-block-blog-listing',
    previewComponent: 'werkl-cms-preview-blog-listing',
    defaultConfig: {
        marginBottom: null,
        marginTop: null,
        marginLeft: null,
        marginRight: null,
        sizingMode: 'boxed',
    },
    slots: {
        listing: 'blog',
    },
});
