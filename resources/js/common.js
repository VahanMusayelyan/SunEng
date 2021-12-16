import API from "./api";
import axios from "axios";
import api from "./api";
export default {
    data() {
        return {}

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

        }
    }
}
