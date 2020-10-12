<template>
    <b-container>
        <h1 class="title">Blogs</h1>
        <router-link to="create-blog" class="add-post">
        <b-icon icon="pencil-square" aria-label="Add Post" font-scale="2"></b-icon>
        </router-link>


            <b-card
                v-for="(post, i) in posts" :key="i"
                img-src="/img/spiderman.jpg"
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 40rem;"
                class="mb-2"
            >
            <div class="icon-style">
                <b-icon icon="hand-thumbs-up" font-scale="1.5"></b-icon>
                <b-icon icon="chat" font-scale="1.5"></b-icon>

                <b-icon v-b-modal.modal-1 icon="pencil" font-scale="1.5" @click="editModal(post, i)"></b-icon>
                <b-icon v-b-modal.modal-center icon="trash" font-scale="1.5" @click="deleteModal(post, i)"></b-icon>
            </div>
                <h1 class="image-title">{{ post.title }}</h1>
                <b-card-text>
                    <router-link to="profile" class="link-to">marfilyuki</router-link>  <read-more more-str="Read more" :text="post.description" less-str="Read less" :max-chars="300"></read-more> 
                    <p class="min-ago">{{ post.created_at | moment("from") }}</p>
                </b-card-text>


            </b-card>
            <!-- Edit modal -->
            <div>
                <b-modal id="modal-1" size="lg" title="You are on edit mode" @ok="editPost" ok-title="Update">

                    <b-form-group
                    class="mb-0"
                    label="Title"
                    label-for="textarea-formatter"
                    description="Edit the title here!"
                    >
                        <b-form-textarea
                            id="title"
                            v-model="editData.title"
                            placeholder="Enter your title.."
                        >
                        
                        </b-form-textarea>
                    </b-form-group>

                    <b-form-group
                    class="mb-0"
                    label="Description"
                    label-for="textarea-formatter"
                    description="Edit your description here"
                    >
                        <b-form-textarea
                            id="description"
                            v-model="editData.description"
                            placeholder="Enter your description.."
                        ></b-form-textarea>
                    </b-form-group>
                </b-modal>
            <!-- End of edit modal -->

            <!-- Delete modal -->
              <!-- <b-modal id="modal-center" centered title="Confirmation" cancel-variant="light" ok-variant="danger" ok-title="Delete" @ok="deletePost">
                <p class="my-4">Are you sure you want to delete this post?</p>
              </b-modal> -->
            <!-- End of Delete modal -->
            <!-- <deleteModal></deleteModal> -->
            <deleteModal></deleteModal>
            </div>

    </b-container>
</template>

<script>
import deleteModal from '../common/deleteModal.vue'
import {mapGetters} from 'vuex'
export default {

    data() {
        return {
            posts : [],
            index : -1,
            editData: {
                title: '',
                description: ''
            }
        }
    },

    methods: {

        async editPost() {
                            
            let titleVal = this.editData.title.trim()
            let descVal = this.editData.description.trim()
            if(descVal == '' && titleVal == '') return this.error('Please fill in the form to post your memorable story for today.')
                else if(titleVal == '') return this.error('Please enter the title for this post.')
                else if(descVal == '') return this.error('Please enter the description for this post.')
            
            const res = await this.callApi('post', '/edit-post', this.editData)

            if(res.status == 200 || res.status == 201) {
                this.posts[this.index].title = this.editData.title
                this.posts[this.index].description = this.editData.description
                return this.success('Your post has been updated successfully!')
            } else {
                if(res.status==422) {
                    if(res.data.errors.description && res.data.errors.title){
                        return this.error('Please fill in the form to post your memorable story for today.')

                    } 
                    
                    else if (res.data.errors.description) {
                        return this.error(res.data.errors.description[0])
                    }
                    
                    else if (res.data.errors.title){
                        return this.error(res.data.errors.title[0])
                    }

                    else {
                        this.swr();
                    }
                }
                else {
                    this.swr()
                }

            }

        },

        editModal(post, index) {
            let editObj = {
                id : post.id,
                title : post.title,
                description : post.description
            }
            this.editData = editObj
            this.index = index
        },

        deleteModal(post, index) {
            let deleteModalObj = {
                confirmationMessage : 'Are you sure you want to delete this post?',
                deleteUrl : '/delete-post',
                data : post,
                deletePostIndex : index,
                isRemoved : false
            }

            this.$store.dispatch('setDeleteDataAction', deleteModalObj)

            // this.deletePostIndex = index
            // this.deletePostAttrib = post
        }


    },

    async created() {
        const res = await this.callApi('get', '/get-post')
        if(res.status == 200) {
            this.posts = res.data
        }
    },

    components : {
        deleteModal
    },

    computed : {
        ...mapGetters(['getDeleteModalObj'])
    },

    watch : {
        getDeleteModalObj(obj) {
            if(obj.isRemoved) {
                this.posts.splice(obj.deletePostIndex, 1)
            }

        }
    }

}
</script>