import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

import userInfoCounts from './modules/userInfoCounts';

export default new Vuex.Store({
    modules : {
        userInfoCounts
    }
})