<template>
    <div id="navbar">
        <Index />
        <router-view />
    </div>
</template>

<script>
import Index from "./Index"

export default {
    name: 'App',
    components: {
        Index
    }
}
</script>

<style>

</style>
