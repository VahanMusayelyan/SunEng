<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="fruit in fruits">
                <td>{{ fruit.id }}</td>
                <td>{{ fruit.name }}</td>
                <td>{{ fruit.price }}</td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>
import API from "../../api";
export default {
    name: "Index",
    data() {
        return {
            fruits: null,
        }
    },
    methods: {
        getFruits() {
            API.post("/api/auth/fruits")
                .then(response => {
                    this.fruits = response.data

                })
                .catch(error => {
                    console.log(error)
                })
        },

    },
    mounted() {
        this.getFruits();
    },
}
</script>

<style scoped>

</style>
