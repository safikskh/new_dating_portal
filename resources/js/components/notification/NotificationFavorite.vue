<template>
  <div
    class="main-notification-list"
    style="padding-bottom:10px"
    v-on:click="markMessageAsRead(unreadfavorite.data.user.id)"
  >
    <div class="media">
      <div class="main-img-user online">
        <img
          @error="onImageLoadFailure($event)"
          :src="'/' + unreadfavorite.data.user.portalInfo.profilePicture"
        />
      </div>
      <div class="media-body">
        <p>{{checkMessage(unreadfavorite.data.thread.detail)}}</p>
        <span>{{ unreadfavorite.data.user.portalInfo.userName }} @ {{unreadfavorite.updated_at | formatDateTime}}</span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["unreadfavorite"],
  data() {
    return {
      threadUrl: "",
    };
  },
  mounted() {
    this.threadUrl = "thread/" + this.unreadfavorite.data.thread.id;
  },
  methods: {
    markMessageAsRead(userid) {
      axios
        .get("/read_messages/" + userid)
        .then((response) => {
          if (response.status == 200) {
            window.location = "/favchat?id=" + userid;
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