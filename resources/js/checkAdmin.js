//
// import API from "./api";
//
//
// const checkAdmin = API.post("/api/auth/me", {access_token: localStorage.getItem("access_token")})
//     .then(res => {
//         console.log(res.data.role_id)
//         if(res.data.role_id == 0){
//             this.$router.push({name : "home"})
//         }
//     }).catch(error =>  {
//         console.log(error)
//     })
//
//
// export default checkAdmin
