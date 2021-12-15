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
                <td @mouseover="mouseOver" >
                    <button v-tooltip="message" class="btn btn-primary">
                    {{ fruit.name }}
                </button></td>
                <td>{{ fruit.price }}</td>
            </tr>

            </tbody>
        </table>
        <span data-toggle="popover" data-content="ASDF">Super simple</span>
    </div>
</template>

<script>
import API from "../../api";
import Vue from 'vue'
import { VTooltip, VPopover, VClosePopover } from 'v-tooltip'

Vue.directive('tooltip', VTooltip)
Vue.directive('close-popover', VClosePopover)
Vue.component('v-popover', VPopover)

export default {
    name: "Index",
    data() {
        return {
            fruits: null,
            hovered: false,
            translate : null,
            message: 'This is a button.'
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
        mouseOver(event) {
            setTimeout(() => {
                this.hovered = true

                if (this.hovered) {
                    this.translate = event.target.innerText
                    axios.post('/api/translation', {translate : this.translate})
                        .then(response => {
                            this.hovered = false
                            console.log(response)
                        }).catch(error => {
                        console.log(error)
                    })
                }

            }, 2000)
        }

    },
    mounted() {
        this.getFruits();
    },
}
</script>

<style scoped>

.tooltip {
    display: block !important;
    z-index: 10000;
}

.tooltip-inner {
    background: black;
    color: white;
    border-radius: 16px;
    padding: 5px 10px 4px;
}

.tooltip-arrow {
    width: 0;
    height: 0;
    border-style: solid;
    position: absolute;
    margin: 5px;
    border-color: black;
    z-index: 1;
}



</style>
