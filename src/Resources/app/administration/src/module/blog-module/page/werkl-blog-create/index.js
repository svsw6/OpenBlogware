export default {
    methods: {
        async createdComponent() {
            Shopware.Store.get('adminMenu').collapseSidebar();

            const isSystemDefaultLanguage = Shopware.State.getters['context/isSystemDefaultLanguage'];
            this.cmsPageState.setIsSystemDefaultLanguage(isSystemDefaultLanguage);
            if (!isSystemDefaultLanguage) {
                Shopware.State.commit('context/resetLanguageToDefault');
            }

            if (Shopware.Context.api.languageId !== Shopware.Context.api.systemLanguageId) {
                Shopware.State.commit('context/setApiLanguageId', Shopware.Context.api.languageId);
            }

            this.resetCmsPageState();

            this.createPage();
            this.createBlog(this.page.id);
            this.isLoading = false;

            this.setPageContext();
        },

        createBlog(pageId) {
            this.blog = this.blogRepository.create();
            this.blog.cmsPageId = pageId;
            this.blogId = this.blog.id;
        },
    },
};
