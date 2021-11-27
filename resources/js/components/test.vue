<template>
    <div>
        <h1>Test</h1>
    </div>
</template>
<script>
export default {
    data() {
        return {
            counter: 0
        }
    },

    beforeUpdate() {
        console.log(this.counter) // Logs the counter value every second, before the DOM updates.
    },

    created() {
        setInterval(() => {
            this.counter++
        }, 1000)
        console.log(this.counter)
    },
}
</script>
