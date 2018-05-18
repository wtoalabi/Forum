export default {
    methods:{
        getName(user){
            if(this.isLoggedIn(user.id)){            
                return "You"
            }
            else{
                return user.name
            } 
        },
        getObjectOwner(objectUser, subjectUser){        
            if(this.isLoggedIn(objectUser.id)){
                return "your"
            }
             else if(this.sameOwner(objectUser, subjectUser)){
                 return "their"
            } 
            else{
                return objectUser.name
            }
        },
        isLoggedIn(user){
            return this.$store.state.loggedInUserID == user
        },
        objectThreadUrl(data){
            return '/forums#/threads/'+data.object.category.slug + '/' + data.object.slug
        },
        subjectThreadUrl(data){
            return '/forums#/threads/'+data.subject.category.slug + '/' + data.subject.slug
        },
        objectUserProfile(user){
            return '/profile/'+user.username
        },
        sameOwner(objectUser, subjectUser){
            return objectUser.id == subjectUser.id
        }
    },
}