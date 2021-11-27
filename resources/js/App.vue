<template>
    <div id="navbar">
        <Navbar />
        <router-view />
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import Methods from './components/methods.vue';

export default {
    name: 'app',
    components: {
        Navbar, Methods
    }
}
</script>

<style>

</style>
