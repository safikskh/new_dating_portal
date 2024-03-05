<template>
    
</template>
<script>
export default {
    props: ['user', 'user2'],
    data() {
        return {
            friend: this.user2
        }
    },
    mounted() {
        this.listen();
    },
    methods: {
        listen() {
            Echo.join('chat')
                .joining((user) => {
                    axios.put('/api/user/'+ user.id +'/online?api_token=' + user.api_token, {});
                })
                .leaving((user) => {
                    axios.put('/api/user/'+ user.id +'/offline?api_token=' + user.api_token, {});
                })
                .listen('UserOnline', (e) => {
                    this.friend = e.user;
                })
                .listen('UserOffline', (e) => {
                    this.friend = e.user;
                });
        },        
    }
}
</script>

