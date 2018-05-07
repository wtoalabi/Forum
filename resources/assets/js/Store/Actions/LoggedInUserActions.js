export default {
    getUser({commit}, payload){
        axios('api/user/' + payload).then(response=>{
            console.log(response.data)
        })
    }
}