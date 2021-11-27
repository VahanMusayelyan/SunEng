<template>
    <div>
        <h1>The number is {{ views }}</h1>
        <button @click="updateCounter(1)">Increase</button>
        <button @click="updateCounter(-1)">Decrease</button>
        <br><br><br>
        <div v-for="(blog, i) in blogs" :key="i" v-if="blogs.length">
            <h1>{{blog.title}}</h1>
            <p>{{blog.post}}</p>
            <p>{{blog.id}}</p>
        </div>
        <br><br><br>
        <div>
            <h1 v-if="showItem"> Show item if "shoItem" is false</h1>
            <h1 v-if="!showItem">Show item if "shoItem" is true</h1>
        </div>
        <button @click="shoItemUpdate()">Change button</button>
    </div>
</template>

<script>
export default {
    name: "methods",
    data() {
        return {
            views: 0,
            blogs: [],
            showItem : false
        }
    },
    methods: {
        updateCounter(number) {
            this.views += number;
        },
        shoItemUpdate(){
            this.showItem = !this.showItem
        }
    },
    created() {
        this.views = 100;
        let post = [
            {"title": "Title 1", "id": "1", "post": "this is post 1"},
            {"title": "Title 2", "id": "2", "post": "this is post 2"},
            {"title": "Title 3", "id": "3", "post": "this is post 3"},
        ];
        this.blogs = post;
    }
}
</script>

<style scoped>

</style>
