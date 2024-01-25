// import BootstrapVue from "bootstrap-vue";
import moment from 'moment';
import Toaster from "v-toaster";
import "v-toaster/dist/v-toaster.css";
// import bEmbed from "bootstrap-vue/es/components/embed/embed";
import VueChatScroll from 'vue-chat-scroll'

require('./bootstrap');
window.Vue = require('vue');
Vue.use(Toaster, {
    timeout: 5000
});
Vue.use(VueChatScroll)

Vue.use(require('vue-moment'));
Vue.filter('formatDateTime', function (value) {
    if (value) {

        return moment(String(value)).format('Do MMM YYYY, H:mm')

    }
});
Vue.filter('formatDate', function (value) {
    if (value) {

        return moment(String(value)).format('Do MMM YYYY')
    }
});
Vue.filter('formatAgo', function (value) {
    if (value) {

        return moment(value, 'YYYY.MM.DD').fromNow();
    }
});

Vue.component('room-chat', require('./components/RoomChat.vue').default);

Vue.component("latest-chat", require("./components/chat/Latest.vue").default);
Vue.component("user-chat", require("./components/chat/UserChat.vue").default);
Vue.component("message", require("./components/chatRoom/Message.vue").default);
Vue.component("online-user", require("./components/chatRoom/OnlineUser.vue").default);
Vue.component("emoji", require("./components/chatRoom/Emoji.vue").default);
Vue.component('notification', require('./components/notification/Notification.vue').default);
Vue.component('inbox-notification', require('./components/notification/InboxNotification.vue').default);
Vue.component('online-by-chatroom', require('./components/OnlineByChatRoom.vue').default);
// Vue.component("b-embed", bEmbed);

const app = new Vue({
    el: '#app',
    methods: {
        onImageLoadFailure(event) {
            event.target.src = "/dashlead/img/default/404-dp-sm.png";
        },
    },
});
