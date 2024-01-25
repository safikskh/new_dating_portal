<template>
  <div class="media" :class="checkActiveUser" @click.prevent="openChat(user)">
    <div class="main-img-user online">
      <img @error="onImageLoadFailure($event)" v-bind:src="user.portalInfo.profilePicture" />
    </div>
    <template>
      <div class="media-body">
        <div class="media-contact-name">
          <span style="font-weight: bold; text-transform: capitalize;">
            {{user.userName }}
            <i
              v-if="promotionInfo"
              class="fa fa-star text-warning"
              aria-hidden="true"
            ></i>
          </span>
          <span
            v-if="lastMessage != 'not found' && lastMessage != ''"
          >{{lastMessage.data.thread.updated_at | formatAgo}}</span>
        </div>
        <p v-if="lastMessage != 'not found' && lastMessage != ''">
          <span>{{messageMinimize(lastMessage.data.thread.detail)}}</span>
        </p>
      </div>
    </template>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: ["userObj", "textUser", "authUser", "currentUser"],
  name: "user-list",
  data() {
    return {
      users: [],
      user: this.userObj,
      lastMessage: {
        data: {
          thread: {
            detail: "",
            user_id: "",
          },
        },
      },
      lastUserText: this.lastText,
      currentTabUser: "",
      authChatUser: this.authUser,
      isReadMessage: false,
      promotionInfo: "",
    };
  },
  mounted() {
    this.lastUserMessage(this.user.id);

    console.log(this.user.id);
    Echo.private("App.User." + this.authChatUser).notification(
      (notification) => {
        console.log("called user list channel");
        let newUnreadNotifications = {
          data: { thread: notification.thread, user: notification.user },
          id: notification.id,
        };
        this.checkUser(newUnreadNotifications);
      }
    );
  },
  computed: {
    checkActiveUser() {
      if (this.currentUser.id == this.user.id) {
        return "active";
      }
    },
  },
  methods: {
    onImageLoadFailure(event) {
      event.target.src = "/dashlead/img/default/404-dp-sm.png";
    },
    promotedMessage(message) {
      var id = message.id;
      axios
        .get("/get_message_info/" + id)
        .then((response) => {
          if (response.status == 200) {
            this.promotionInfo = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    checkUser(notif) {
      if (
        notif.data.user.id == this.user.id &&
        notif.data.thread.portal_id == this.user.portalInfo.portal_id
      ) {
        if (
          notif.data.thread.notificationType == 1 ||
          notif.data.thread.notificationType == 2
        ) {
          this.isReadMessage = false;
          this.promotionInfo = notif.data.thread.isPromoted;
          return (this.lastMessage = notif);
        }
      }
    },
    tooltipText(user) {
      return (
        this.stringCheck(user.userName) +
        "\n" +
        this.stringCheck(user.portalInfo.humanTime) +
        " år - " +
        this.regionCheck(user.portalInfo.regionName) +
        "\n Postnummer: " +
        this.stringCheck(user.portalInfo.zipCode) +
        "\n Søger: " +
        this.strReplace(JSON.parse(user.portalInfo.searching)) +
        "\n Højde: " +
        this.stringCheck(user.portalInfo.height) +
        "\n Vægt: " +
        this.stringCheck(user.portalInfo.weight) +
        "\n Børn: " +
        this.stringCheck(user.portalInfo.children) +
        "\n Matchord: " +
        this.strReplace(JSON.parse(user.portalInfo.matchWords))
      );
    },
    stringCheck(data) {
      if (data != null) {
        return data;
      } else {
        return "";
      }
    },
    strReplace(str) {
      if (str != null) {
        return str.join(", ");
      }
      return "";
    },
    matchWords(data) {
      if (data != null) {
        if (typeof data === "object") {
          return Object.values(data);
        } else {
          return "data";
        }
      } else {
        return "";
      }
    },
    arrayCheck() {},
    regionCheck(data) {
      if (data != null) {
        return data;
      } else {
        return "";
      }
    },
    messageMinimize(message) {
      if (message == null) return "Har sendt et billede";
      if (message.length > 18) return message.substring(0, 18) + ". . .";
      else return message;
    },
    lastUserMessage(id) {
      axios
        .get("/last_message/" + id)
        .then((response) => {
          this.lastMessage = response.data;
          this.promotedMessage(this.lastMessage.data.thread);
          if (this.lastMessage.read_at != null)
            return (this.isReadMessage = true);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    openChat(user) {
      this.$emit("chatBoxUser", user);
      this.$root.$emit("callNotifComponent", user);

      axios
        .get("/read_messages/" + user.id)
        .then((response) => {
          if (response.status == 200) {
            this.isReadMessage = true;
            if (this.promotionInfo) {
              this.promotionInfo = 0;
            }
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  watch: {
    textUser: function (newVal, oldVal) {
      // watch it
      if (newVal.user_id == this.user.id) {
        this.isReadMessage = true;
        if (this.promotionInfo) {
          this.promotionInfo = 0;
        }
      }
    },
  },
};
</script>

<style>
</style>
