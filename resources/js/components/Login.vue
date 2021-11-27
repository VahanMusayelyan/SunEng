<template>
    <div>
        <h2>Login Page Placeholder</h2>

        <input v-model="data.tagName" placeholder="Add tag name"/>

        <button type="submit" v-on:click="addTag()" > ADD </button>


    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {
                tagName: ''
            }
        }
    },
    name: 'Login',
    methods:{
        async addTag() {

            if (this.data.tagName.trim() == '') return "required";
            const res = await this.callApi('post', 'app/create_tag', this.data)

            if (res.status === 200) {
                alert(res.data.msg)
                this.data.tagName = ''
            } else {
                    alert("something went wrong")

            }

        },
    }
}
</script>

<style scoped>

</style>
