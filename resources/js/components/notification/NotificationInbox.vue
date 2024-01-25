<template>
  <div
    class="main-notification-list"
    style="padding-bottom:10px"
    v-on:click="markMessageAsRead(unreadsinbox.data.user.id)"
  >
    <div class="media">
      <div class="main-img-user online">
        <img
          @error="onImageLoadFailure($event)"
          :src="'/' + unreadsinbox.data.user.portalInfo.profilePicture"
        />
      </div>
      <div class="media-body">
        <p>{{checkMessage(unreadsinbox.data.thread.detail)}}</p>
        <span>{{ unreadsinbox.data.user.portalInfo.userName }} @ {{unreadsinbox.updated_at | formatDateTime}}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["unreadsinbox"],
  data() {
    return {
      threadUrl: "",
    };
  },
  mounted() {},
  methods: {
    markMessageAsRead(userid) {
      axios
        .get("/read_messages/" + userid)
        .then((response) => {
          if (response.status == 200) {
            window.location = "/chat?id=" + userid;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    checkMessage(data) {
      if (data != null) {
        return data.substring(0, 20) + "...";
      } else {
        return "Har sendt et billede";
      }
    },
  },
};
</script>
