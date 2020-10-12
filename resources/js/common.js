export default {
    data() {
        return {

        }
    },

    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                  })  
            } catch (error) {
                return error.response
            }
        },

        success(msg) {
            this.$bvToast.toast(msg, {
                title: 'Success!',
                variant: 'success',
                solid: true
            })
        },

        error(msg) {
            this.$bvToast.toast(msg, {
                title: 'Oops!',
                variant: 'danger',
                solid: true
            })
        },

        swr() {
            this.$bvToast.toast('Something went wrong. Please report this error to the developer. Thank you!', {
                title: 'Oh no!',
                variant: 'danger',
                solid: true
            })
        }

        
    }
}