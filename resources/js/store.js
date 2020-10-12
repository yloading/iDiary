import Vue from 'vue'
import Vuex from 'vuex'
import { lte } from 'lodash'
Vue.use(Vuex)


export default new Vuex.Store({
    state : {
        counter : 100,
        deleteModalObj : {
            confirmationMessage : '',
            deleteUrl : '',
            data : null,
            deletePostIndex : -1,
            isRemoved : false
        },
        user : false
    },

    getters : {
        getDeleteModalObj(state){
            return state.deleteModalObj
        }
    },

    mutations : {
        changeTheCounter(state, data) {
            state.counter += data
        },

        deleteThisPost(state, data) {
            state.deleteModalObj = data
        },

        postIsDeleted(state, data) {
            const deleteModalObj = {
                confirmationMessage : '', 
                deleteUrl : data.deleteUrl,
                data : data.data,
                deletePostIndex : data.deletePostIndex,
                isRemoved : data.isRemoved
            }

            state.deleteModalObj = deleteModalObj
        },

        userDetails(state, data) {
            state.user = data
        }

    },

    actions : {
        changeTheCounterAction({commit}, data) {
            commit('changeTheCounter', data)
        },

        setDeleteDataAction({commit}, data) {
            commit('deleteThisPost', data)
        },

        postIsDeletedAction({commit}, data) {
            commit('postIsDeleted', data)
        }

    }

})