<template>
    <b-container>
        <h1 class="title">How's your day today?</h1>
    <b-form-group
      class="mb-0"
      label="Title"
      label-for="textarea-formatter"
      description="Input the best title for this day!"
    >
      <b-form-textarea
        id="title"
        v-model="data.title"
        placeholder="Enter your title.."
      ></b-form-textarea>
    </b-form-group>
    <b-form-group
      class="mb-0"
      label="Description"
      label-for="textarea-formatter"
      description="What happened today?"
    >
      <b-form-textarea
        id="description"
        v-model="data.description"
        placeholder="Enter your description.."
      ></b-form-textarea>
    </b-form-group>
    <b-form-group
      class="mb-0"
      label="Image"
      label-for="textarea-formatter"
      description="Upload your most memorable image today!"
    >
        <b-form-file
        v-model="file"
        id="file"
        @input="onChangeImage"
        placeholder="Choose a file or drop it here..."
        drop-placeholder="Drop file here..."
        ></b-form-file>
        
        <img v-if="imageUrl" :src="imageUrl" />

        <p></p>
    </b-form-group>

    <b-button block :pressed="true" variant="outline-light" @click="addPost">Post</b-button>
    <b-button block :pressed="true" variant="outline-danger" router-link to="blog">Back</b-button>

    </b-container>
</template>
<script>
export default {

    data() {
        return {
            data : {
                title: '',
                description: '',
            },
            imgSrc : '',
            file : null,
            imageUrl : ''
        }
    },

    methods : {
        async addPost() {
            let titleVal = this.data.title.trim()
            let descVal = this.data.description.trim()
            if(descVal == '' && titleVal == '') return this.error('Please fill in the form to post your memorable story for today.')
                else if(titleVal == '') return this.error('Please enter the title for this post.')
                else if(descVal == '') return this.error('Please enter the description for this post.')
            console.log(this.data)
            const res = await this.callApi('post', '/store-post', this.data)

            if(res.status == 200 || res.status == 201) {
                this.data.title = ''
                this.data.description = ''
                return this.success('Your memorable day today has been posted successfully!')  
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

            }

        },

        onChangeImage() {
            let reader = new FileReader();

            reader.onload = function (e) {
                console.log(this)
                this.imageUrl = e.target.result;
            }

            reader.readAsDataURL(this.file); 

            
            
            // var imageFile = this.file
            // this.imageUrl = URL.createObjectURL(imageFile)
        }
    }



    // async created() {
    //     const res = await this.callApi('post', '/store-post', {title: 'test', description: 'ulol'})
    //     if(res.status == 200) {
    //         console.log(res)
    //     }

//   }

}
</script>