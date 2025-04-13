export default {
    methods: {
        createdComponent() {
            Shopware.State.commit('context/resetLanguageToDefault');

            this.blogAuthor = this.blogAuthorRepository.create(Shopware.Context.api);
        },
    },
};
