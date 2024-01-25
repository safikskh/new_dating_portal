<template>
  <div class="dropdown main-header-notification">
    <a class="nav-link icon" href="#">
      <i class="fe fe-bell" style="color:white;"></i>
      <span class="pulse bg-danger" v-if="uothersnotif.length > 0"></span>
    </a>
    <div class="dropdown-menu">
      <div class="header-navheading">
        <p class="main-notification-text">Du har {{ uothersnotif.length}} ulæste meddelelser</p>
      </div>
      <div
        class="main-notification-list"
        v-for="unreadothers in uothersnotif"
        :key="unreadothers.id"
      >
        <div
          v-if="!unreadothers.data.thread.isGroupRequest"
          v-on:click="markMessageAsRead(unreadothers.data.thread,unreadothers.data.user, unreadothers.id)"
        >
          <!-- Group Comment -->
          <div class="media" v-if="unreadothers.data.thread.isGroupComment">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Ny kommentar til gruppe {{unreadothers.data.thread.groupName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Group Comment -->
          <!-- Blog Comment -->
          <div class="media" v-if="unreadothers.data.thread.isBlogComment">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Ny kommentar til bloggen {{unreadothers.data.thread.blogName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Blog Comment -->
          <!-- Group Join -->
          <div class="media" v-if="unreadothers.data.thread.isGroupJoin">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Nyt medlem i gruppen {{unreadothers.data.thread.groupName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Group Join -->
          <!-- Group Join Request-->
          <div class="media" v-if="unreadothers.data.thread.isApproveGroupJoinRequest">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Anmodning accepteret to {{unreadothers.data.thread.groupName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Group Join Request -->
          <!-- Reject Group Join Request-->
          <div class="media" v-if="unreadothers.data.thread.isRejectGroupJoinRequest">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Afvis din tilmeldingsanmodning til {{unreadothers.data.thread.groupName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Reject Group Join Request -->
          <!-- Event Join-->
          <div class="media" v-if="unreadothers.data.thread.isEventJoin">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Join new member on {{unreadothers.data.thread.eventName}}</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- Event Join -->
          <!-- User Rating-->
          <div class="media" v-if="unreadothers.data.thread.isUserRating">
            <div class="main-img-user online">
              <img
                @error="onImageLoadFailure($event)"
                :src="'/' + unreadothers.data.user.portalInfo.profilePicture"
              />
            </div>
            <div class="media-body">
              <p>Du har fået {{unreadothers.data.thread.rating_value}} stjernet rating</p>
              <span>{{unreadothers.data.user.portalInfo.userName}} @ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
          <!-- User Rating -->
        </div>
        <div v-if="unreadothers.data.thread.isGroupRequest">
          <div class="media" v-if="unreadothers.data.thread.isGroupRequest">
            <div class="media-body">
              <p>Anmodning om medlemskab {{unreadothers.data.thread.groupName}}</p>
              <p>
                <button
                  @click="accept(unreadothers.data.thread.group_id,
                                    unreadothers.data.user.id,
                                    unreadothers)"
                  type="button"
                  class="notif-accept-btn btn-radiaus small"
                >Acceptér</button>
                <button
                  @click="reject(
                                        unreadothers.data.thread.group_id,
                                        unreadothers.data.user.id,
                                        unreadothers
                                        )"
                  type="button"
                  class="notif-reject-btn btn-radiaus small"
                >Afvis</button>
              </p>
              <span
                @click="userprofile(unreadothers.data.user.id)"
              >{{unreadothers.data.user.portalInfo.userName}}</span>
              <span>@ {{unreadothers.updated_at | formatDateTime}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["othersunreads", "userid"],
  data() {
    return {
      uothersnotif: this.othersunreads,
    };
  },
  methods: {
    accept(group_id, user_id, thread) {
      var notificationList = this.uothersnotif;
      var threadID = thread.id;
      axios
        .post("/approvedToJoin", {
          group_id: group_id,
          user_id: user_id,
          thread_id: threadID,
        })
        .then((response) => {
          if (response.status == 200) {
            var index = notificationList.indexOf(thread);
            if (index > -1) {
              notificationList.splice(index, 1);
            }
          }
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    reject(group_id, user_id, thread) {
      var notificationList = this.uothersnotif;
      var threadID = thread.id;
      axios
        .post("/rejectToJoin", {
          group_id: group_id,
          user_id: user_id,
          thread_id: threadID,
        })
        .then((response) => {
          if (response.status == 200) {
            var index = notificationList.indexOf(thread);
            if (index > -1) {
              notificationList.splice(index, 1);
            }
          }
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    userprofile(id) {
      window.open("/profile?user_id=" + id, "_blank");
    },
    markMessageAsRead(type, user, id) {
      axios.get("/markAsRead/" + id).then(function (response) {
        if (response.status == 200) {
          if (type.isEventJoin) {
            window.location = "/eventDetails/" + type.event_id;
          } else if (type.isUserRating) {
            window.location = "/profile?user_id=" + user.id;
          } else if (type.isBlogComment) {
            window.location = "/blogDetails/" + type.blog_id;
          } else {
            window.location = "/groupDetails/" + type.group_id;
          }
        }
      });
    },
    checkUser(isDisablePushNotif, notificationType, newNotif) {
      if (notificationType == 3) {
        //favorite user message notification
        this.uothersnotif.push(newNotif);
        this.pushNotification(isDisablePushNotif, notificationType, newNotif);
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
        if (type == 3) {
          alert = "New notification!";
          if (notif.data.thread.isGroupComment) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " comented on your group post";
            url = "/groupDetails/" + notif.data.thread.group_id;
          } else if (notif.data.thread.isGroupJoin) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " join your " +
              notif.data.thread.groupName;
            url = "/groupDetails/" + notif.data.thread.group_id;
          } else if (notif.data.thread.isGroupRequest) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " Requested to join " +
              notif.data.thread.groupName;
            url = "/profile?user_id=" + notif.data.user.id;
          } else if (notif.data.thread.isApproveGroupJoinRequest) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " Accept your join request to  " +
              notif.data.thread.groupName;
            url = "/profile?user_id=" + notif.data.user.id;
          } else if (notif.data.thread.isRejectGroupJoinRequest) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " Reject your join request to " +
              notif.data.thread.groupName;
            url = "/profile?user_id=" + notif.data.user.id;
          } else if (notif.data.thread.isEventJoin) {
            message =
              "@" + notif.data.user.portalInfo.userName + " join your event";
            url = "/eventDetails/" + notif.data.thread.event_id;
          } else if (notif.data.thread.isUserRating) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " given " +
              notif.data.thread.rating_value +
              " stars";
            url = "/profile?user_id=" + notif.data.user.id;
          } else if (notif.data.thread.isBlogComment) {
            message =
              "@" +
              notif.data.user.portalInfo.userName +
              " comented on your blog post";
            url = "/blogDetails/" + notif.data.thread.blog_id;
          } else {
            message =
              "@" + notif.data.user.portalInfo.userName + " posted on group";
            url = "/groupDetails/" + notif.data.thread.group_id;
          }
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
    readPushNotif(thread) {
      axios.get("/markAsRead/" + thread.id);
    },
  },
  mounted() {
    // console.log('Notification Component mounted.');
    Echo.private("App.User." + this.userid).notification((notification) => {
      let newUnreadNotifications = {
        data: { thread: notification.thread, user: notification.user },
        updated_at: notification.updated_at,
        id: notification.id,
      };
      this.checkUser(
        notification["thread"]["isDisablePushNotif"],
        notification["thread"]["notificationType"],
        newUnreadNotifications
      );
    });
  },
};
</script>
