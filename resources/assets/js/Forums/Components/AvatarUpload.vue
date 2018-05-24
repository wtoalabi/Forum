<template>
<div>
    <input type="file" name="avatar" ref="avatar" accept="image/*" @change="avatarUpload()">
            <img :src="avatar" alt="">
</div>
</template>

<script>
 
export default {
 
mounted() {

},
data(){
    return{
        avatar: ''
    }
},
methods:{
    avatarUpload(){
        let avatar = this.$refs.avatar.files[0]
        let file = new FileReader()
        file.readAsDataURL(avatar)
        file.onload= (e)=>{
            this.avatar = e.target.result;        
            }
        let formData = new FormData();
        formData.append('avatar', avatar)
        return axios.post('api/user-avatar',formData) 
    },
}

}
 
</script>