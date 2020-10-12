<template>
<div>
    <b-modal id="modal-center" centered title="Confirmation" cancel-variant="light" ok-variant="danger" ok-title="Delete" @ok="deletePost">
        <p class="my-4">{{this.getDeleteModalObj.confirmationMessage}}</p>
    </b-modal>
</div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
    data() {
        return {

        }
    }, 

    methods : {
        async deletePost() {
            const res = await this.callApi('post', this.getDeleteModalObj.deleteUrl, this.getDeleteModalObj.data)

            if(res.status == 200) {
                this.getDeleteModalObj.isRemoved = true
                this.$store.dispatch('postIsDeletedAction', this.getDeleteModalObj)
                this.success('This post has been deleted successfully!')

            }
            else {
                this.swr()
            }
        },        
    },

    computed : {
        ...mapGetters(['getDeleteModalObj'])
    },

}
</script>