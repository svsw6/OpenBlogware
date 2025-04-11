const { Component } = Shopware;

Component.register('sw-cms-block-blog-listing', () => import('./component'));
Component.register('werkl-cms-preview-blog-listing', () => import('./preview'));

Shopware.Service('cmsService').registerCmsBlock({
    name: 'blog-listing',
    label: 'werkl-blog.blocks.blog.listing.label',
    category: 'werkl-blog',
    component: 'werkl-cms-block-blog',
    previewComponent: 'werkl-cms-preview-blog-listing',
    defaultConfig: {
        marginBottom: '0px',
        marginTop: '0px',
        marginLeft: '0px',
        marginRight: '0px',
        sizingMode: 'boxed',
    },
    slots: {
        listing: 'blog',
    },
});
