<template>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark">
            <nav class="style-1">
                <router-link to="/" class="btn">Home</router-link>
                <router-link to="login" class="btn">Login</router-link>
                <router-link to="test" class="btn">Test</router-link>
                <router-link to="my" class="btn">My</router-link>
                <router-link to="methods" class="btn">Methods</router-link>
            </nav>


    </div>
</template>

<script>
export default {

}
</script>

<style scoped>

    * {
        -webkit-transition-property: all;
        -webkit-transition-duration: .2s;
        -moz-transition-timing-function: cubic-bezier(100,50,21,6);
        -moz-transition-property: all;
        -moz-transition-timing-function: cubic-bezier(100,50,21,6);
    }
    .style-1 {
        text-align: center;
    }
    .btn{
        color:#999;
        background:rgba(0, 0, 0);
        padding:10px 20px;
        text-decoration:none;
        text-transform:uppercase;
    }

    .btn:hover{
        border:none;
        background:rgba(0, 0, 0, 0.4);
        background:#fff;
        padding:9px 20px;
        color:#1b1b1b;
    }

    .navbar-expand-lg {
        height: 100px;
    }

    nav a{
        margin-right: 20px;
    }

</style>
