const state = {
    title : null
};
const getters = {
};
const mutations = {
    countValue(state,payload){
        state.title = payload;
    }
};
const actions = {
    valueFromServer ({commit} , payload){
        commit('countValue',payload);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}