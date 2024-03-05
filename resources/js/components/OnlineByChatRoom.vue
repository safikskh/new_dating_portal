<template>
    <p>{{online}} online</p>
</template>
<script>
export default {
     props: ["chatroom"],
     data() {
    return {
        chatroomId: this.chatroom,
        allonline: [],
        online: 0,
        temUser:[]
        
    }
    },
    mounted() {
        var chatId = this.chatroomId;
        var on = this.online;
        var temp = [];
        
        this.$root.$on('onlineUsers', (userList) => {
            userList.forEach(function(user){
                if(user.currentChatRoomId != null){
                    if(chatId == user.currentChatRoomId){
                        temp.push(user)
                    }
                }
            })
            this.online = temp.length;
        })
        this.$root.$on('chatroomJoin', (user) => {
                if(user.currentChatRoomId != null){
                    if(chatId == user.currentChatRoomId)
                     temp.push(user)

                }
            this.online = temp.length;
        })
        this.$root.$on('chatroomLeave', (user) => {
                if(user.currentChatRoomId != null){
                    if(chatId == user.currentChatRoomId)
                    temp.pop(user)

                }
            this.online = temp.length;
        })
    },
    methods:{
        allOnline(){
            console.log("all online called");
        }
    }
}
</script>

