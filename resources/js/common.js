import Vue from "vue";
import API from "./api";
import axios from "axios";

import VueNotifications from 'vue-notifications'
import 'jquery'
import toastr from 'toastr'// https://github.com/CodeSeven/toastr
import 'toastr/build/toastr.min.css'

function toast({title, message, type, timeout, cb}) {
    if (type === VueNotifications.types.warn) type = 'warning'
    return toastr[type](message, title, {timeOut: timeout})
}

const options = {
    success: toast,
    error: toast,
    info: toast,
    warn: toast
}

Vue.use(VueNotifications, options)

export default {
    data() {
        return {
            deleteId : null
        }

    },
    methods: {
        async callApi(method, url, dataObj) {
            try {
                return await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
            } catch (e) {
                return e.response
            }

        } ,
        async checkAdmin() {
            let self = this;
            await API.post("/api/auth/me", {access_token: localStorage.getItem("access_token")})
                .then(res => {
                    if(res.data.role_id !== 0){
                        this.$router.push({name : "home"})
                    }
                }).catch(error =>  {
                console.log(error)
            })

        },
        cancelModal(name){
            this.$modal.hide(name)
        },
        deleteModal(deleteId, name) {
            this.deleteId = deleteId;
            this.$modal.show(name)
        },
    },
    notifications: {
        showSuccessMsg: {
            type: VueNotifications.types.success,
            title: 'Success',
            message: 'Your information saved'
        },
        showInfoMsg: {
            type: VueNotifications.types.info,
            title: 'Information',
            message: 'Here is some info for you'
        },
        showWarnMsg: {
            type: VueNotifications.types.warn,
            title: 'Warning',
            message: 'Something went wrong'
        },
        showErrorMsg: {
            type: VueNotifications.types.error,
            title: 'Error',
            message: 'That\'s the error. Please try again'
        }
    },
}
