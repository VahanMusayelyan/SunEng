<template>
    <div class="vue-tempalte container">
        <div class="form-group mb-4">
            <h3>Registration</h3>
            <label for="name">Name</label>
            <input
                v-model="name"
                class="form-control"
                ref="name"
                id="name"
                placeholder="Fill name" />
        </div>
        <div class="form-group mb-4">
            <label for="name">Surname</label>
            <input
                v-model="surname"
                class="form-control"
                ref="surname"
                id="surname"
                placeholder="Fill surname" />
        </div>
        <div class="form-group mb-4">
            <label for="email">Email</label>
            <span class="checkUser"></span>
            <input
                v-model="email"
                v-on:blur="handleEmailBlur()"
                ref="email"
                type="email"
                class="form-control" id="email"
                placeholder="Fill email" />
        </div>
        <div class="form-group mb-4">
            <label for="phone">Phone</label>
            <span class="checkPhone"></span>
            <input
                v-model="phone"
                v-on:blur="handlePhoneBlur()"
                ref="phone"
                class="form-control"
                id="phone"
                placeholder="Fill phone +374" required>
        </div>
        <div class="form-group mb-4">
            <label for="password">Password</label>
            <input
                v-model="password"
                class="form-control"
                   type="password"
                   ref="password"
                   id="password"
                   placeholder="Fill password" required>
        </div>
        <div class="form-group mb-4">
            <label for="password_confirmation">Password confirmation</label>
            <span class="checkPassword"></span>
            <input
                v-model="password_confirmation"
                v-on:blur="handlePasswordBlur()"
                   class="form-control"
                   type="password"
                   ref="password_confirmation"
                   id="password_confirmation"
                   placeholder="Fill password again" required>
        </div>
        <div class="form-group mb-4">
            <button class="btn btn-warning" @click="store()">Submit</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Registration',
    data() {
        return {
                name: '',
                surname: '',
                password: '',
                email: '',
                phone: '',
                password_confirmation: '',
        }
    },

    methods: {
        store(){
            axios.post("/api/users", {
                name :  this.name ,
                email :  this.email ,
                password :  this.password ,
                surname :  this.surname,
                phone :  this.phone,
                password_confirmation :  this.password_confirmation
            })
                .then(res => {
                    localStorage.setItem("access_token", res.data.access_token)
                    this.$router.push({name: "users.personal"})
                })
        },

        async handleEmailBlur(){
            this.email = this.$refs.email.value;
            if(this.$refs.email.value == "") return false;
            const res = await this.callApi('post', '/api/checkUsername', {email : this.email});
            if(res.data.user != null){
                document.querySelector("span");
                document.getElementsByClassName("checkUser")[0].innerHTML = "<strong>This email has been registered</strong>";

            }else{
                document.getElementsByClassName("checkUser")[0].innerHTML = "<strong>You can register this email</strong>";
            }
        },
        async handlePhoneBlur(){
            this.phone = this.$refs.phone.value;
            if(this.$refs.phone.value == "") return false;
            const res = await this.callApi('post', '/api/checkPhone', {phone : this.phone});
            if(res.data.phone != null){
                document.querySelector("span");
                document.getElementsByClassName("checkPhone")[0].innerHTML = "<strong>This phone number has been registered</strong>";

            }else{
                document.getElementsByClassName("checkPhone")[0].innerHTML = "<strong>You can register this phone number</strong>";
            }
        },
        async handlePasswordBlur(){

            if(this.$refs.password.value !== this.$refs.password_confirmation.value){
                document.getElementsByClassName("checkPassword")[0].innerHTML = "<strong>Passwords doesn't match<strong>";
            }else{
                document.getElementsByClassName("checkPassword")[0].innerHTML = "";
            }
        }
    }
}
</script>

<style scoped>

</style>
