import Vue from 'vue'
import Vuex from 'vuex'
import Getters from './Getters/RegisterAllGetters'
import Actions from './Actions/AllActions'
import Mutators from './Mutators/AllMutators'
import States from './States/AllStates'
Vue.use(Vuex);

export default new Vuex.Store({
    state: States,
    mutations: Mutators,
    actions: Actions,
    getters: Getters
})