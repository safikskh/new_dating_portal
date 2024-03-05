<template>
  <div class="dropdown main-header-notification">
    <a class="nav-link icon" href="#">
      <i class="fe fe-mail" style="color:white;"></i>
      <span class="pulse bg-danger" v-if="uinboxnotif.length + ufavnotif.length != 0"></span>
    </a>
    <div class="dropdown-menu">
      <div class="header-navheading">
        <div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">
          <div class="card">
            <div class="card-header" id="headingOne" role="tab">
              <a
                aria-controls="collapseOne"
                aria-expanded="false"
                data-toggle="collapse"
                href="#collapseOne"
              >Beskeder ({{uinboxnotif.length}})</a>
            </div>
            <div
              aria-labelledby="headingOne"
              class="collapse"
              data-parent="#accordion"
              id="collapseOne"
              role="tabpanel"
            >
              <div class="card-body" style="text-align:left;">
                <template v-if="uinboxnotif.length != 0">
                  <notification-inbox
                    v-for="unread in uinboxnotif"
                    :unreadsinbox="unread"
                    :key="unread.id"
                  ></notification-inbox>
                </template>
                <template v-else>
                  <div style="text-align: center;">
                    <h6 style="color:red;">Ingen Tilgængelig Data</h6>
                  </div>
                </template>
                <div style="text-align: center;">
                  <a
                    class="btn btn-dark btn-sm"
                    style="color:white; font-size:10px; text-transform: uppercase; font-weight: bold;"
                    @click="goInbox"
                  >Se Alle Chat</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo" role="tab">
              <a
                aria-controls="collapseTwo"
                aria-expanded="false"
                class="collapsed"
                data-toggle="collapse"
                href="#collapseTwo"
              >Favorit Beskeder ({{ufavnotif.length}})</a>
            </div>
            <div
              aria-labelledby="headingTwo"
              class="collapse"
              data-parent="#accordion"
              id="collapseTwo"
              role="tabpanel"
            >
              <div class="card-body" style="text-align:left;">
                <template v-if="ufavnotif.length != 0">
                  <notification-favorite
                    v-for="unread in ufavnotif"
                    :unreadfavorite="unread"
                    :key="unread.id"
                  ></notification-favorite>
                </template>
                <template v-else>
                  <div style="text-align: center;">
                    <h6 style="color:red;">Ingen Tilgængelig Data</h6>
                  </div>
                </template>
                <div style="text-align: center;">
                  <a
                    class="btn btn-dark btn-sm"
                    style="color:white; font-size:10px; text-transform: uppercase; font-weight: bold;"
                    @click="goFavInbox"
                  >Se Alle Favorit Chat</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NotificationInbox from "./NotificationInbox";
import NotificationFavorite from "./NotificationFavorite";
export default {
  props: ["favoriteunreads", "inboxunreads", "user"],
  components: { NotificationInbox, NotificationFavorite },
  data() {
    return {
      uinboxnotif: this.inboxunreads,
      ufavnotif: this.favoriteunreads,
      userObj: this.user,
    };
  },
  methods: {
    onImageLoadFailure(event) {
      event.target.src = "/dashlead/img/default/404-dp-sm.png";
    },
    goInbox() {
      window.location.href = "/chat";
    },
    goFavInbox() {
      window.location.href = "/favchat";
    },
    checkUser(isDisablePushNotif, notificationType, portalId, newNotif) {
      var userId = newNotif.data.user.id;
      if (
        notificationType == 2 &&
        portalId == this.userObj.portalInfo.portal_id
      ) {
        //favorite user message notification
        this.checkRepeatedNotification(this.ufavnotif, userId, newNotif);
        this.pushNotification(isDisablePushNotif, notificationType, newNotif);
      } else if (
        notificationType == 1 &&
        portalId == this.userObj.portalInfo.portal_id
      ) {
        //user message notification
        this.checkRepeatedNotification(this.uinboxnotif, userId, newNotif);
        this.pushNotification(isDisablePushNotif, notificationType, newNotif);
      }
    },
    checkRepeatedNotification(notificationList, userId, newNotif) {
      var count = 0;
      for (var i = 0; i < notificationList.length; i++) {
        if (notificationList[i].data.user.id == userId) {
          count = 1;
          notificationList.splice(i, 1);
          notificationList.push(newNotif);
        }
      }
      if (count == 0) {
        notificationList.push(newNotif);
      }
    },
    pushNotification(isDisablePushNotif, type, notif) {
      if (isDisablePushNotif == 1) {
        return;
      } else {
        if (!("Notification" in window)) {
          alert("Web Notification is not supported");
          return;
        }
        let alert = "";
        let message = "";
        let url = "";
        if (type == 1) {
          alert = "New message!";
          message = notif.data.thread.detail.substring(0, 30) + "...";
          url = "chat?id=" + notif.data.user.id;
        } else if (type == 2) {
          alert = "New message!";
          message = notif.data.thread.detail.substring(0, 30) + "...";
          url = "favchat?id=" + notif.data.user.id;
        }
        Notification.requestPermission((permission) => {
          let notification = new Notification(alert, {
            body: message, // content for the alert
            icon: "/img/logo.png", // optional image url
          });

          // link to page on clicking the notification
          notification.onclick = () => {
            window.open(url);
          };
        });
      }
    },
  },
  mounted() {
    console.log("Notification Component mounted.");

    Echo.private("App.User." + this.userObj.id).notification((notification) => {
      let newUnreadNotifications = {
        data: { thread: notification.thread, user: notification.user },
        updated_at: notification.updated_at,
        id: notification.id,
      };
      this.checkUser(
        notification["thread"]["isDisablePushNotif"],
        notification["thread"]["notificationType"],
        notification["thread"]["portal_id"],
        newUnreadNotifications
      );
    });
    this.$root.$on("callNotifComponent", (user) => {
      var removeValFromIndex = [];
      var notificationList = this.uinboxnotif;
      var notificationList2 = this.ufavnotif;
      for (var i = 0; i < notificationList.length; i++) {
        if (user.id == notificationList[i].data.user.id) {
          removeValFromIndex.push(i);
        }
      }
      for (var i = removeValFromIndex.length - 1; i >= 0; i--)
        notificationList.splice(removeValFromIndex[i], 1);

      removeValFromIndex = [];
      for (var i = 0; i < notificationList2.length; i++) {
        if (user.id == notificationList2[i].data.user.id) {
          removeValFromIndex.push(i);
        }
      }
      for (var i = removeValFromIndex.length - 1; i >= 0; i--)
        notificationList2.splice(removeValFromIndex[i], 1);
    });
  },
};
</script>
