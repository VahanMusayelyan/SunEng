<template>
    <div id="navbar">
        <AdminNavbar />
        <router-view />
    </div>
</template>

<script>
import AdminNavbar from "./AdminNavbar";

export default {
    name: 'adminapp',
    data(){
        return{

        }
    },
    components: {
        AdminNavbar,
    },
}
</script>

<style>
#navbar{
    display: flex;
}
.content-dashboard{
    border: 1px solid #fa9046;
    border-radius: 15px;
    background-color: #f1f1f1;
    padding: 15px;
    -webkit-box-shadow: 0px 0px 5px 1px #fa9046;
    box-shadow: 0px 0px 5px 1px #fa9046;
}
.borderRed{
    border: 1px solid red;
}
.borderGreen{
    border: 1px solid green;
}
.borderBlue{
    border: 1px solid blue;
}
.orangeText{
    color: #ff6900;
}
.cursor-pointer{
    cursor: pointer;
}
</style>
