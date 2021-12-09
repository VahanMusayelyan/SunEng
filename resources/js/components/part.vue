<template>
    <div>
        <a class="text-img">

        </a>
    </div>

</template>

<script>
import particles from 'particles.js'
import Vue from 'vue'
import VueNumber from 'vue-number-animation'

Vue.use(VueNumber)

export default {
    name: 'app',
    methods: {

    },
    mounted()
    {

    }
}




/* eslint-disable */

</script>



<style>
#appA {
    position: absolute;
    background-color: #000000;
    width: 350px;
    height: 350px;
}
canvas {
    display: block;
    vertical-align: bottom;
}

.lessonsNumber{
    font-size: 120px;
    color: #ed6506;
    position: absolute;
    z-index: 1000000;
    font-weight: 600;
}

#particles-js {
    min-width: 360px;
    min-height: 360px;
}
.text-img {
    -webkit-text-fill-color: transparent;
    background: -webkit-linear-gradient(transparent, transparent);
    background: -o-linear-gradient(transparent, transparent);
    background: linear-gradient(
        -62deg, #45476f, #6689ff);
    -webkit-background-clip: text;
}

.text-img > span {
    pointer-events: none;
}

</style>
