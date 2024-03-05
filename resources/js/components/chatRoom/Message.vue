<template>
  <div>
    <template v-if="side === 'left'">
      <div class="single-chat-area">
        <div class="chat-box-content">
          <div class="img-area image">
            <img  class="rounded-circle" :src="getProfileImage" alt>
          </div>&nbsp;
          <div class="chat-box-text">
            <template v-if="file !== ''">
              <template v-if="isImage(checkFileExtention)">
                <a v-b-modal.showimageModal target="_blank">
                  <br>
                  <b-img 
                    @click.prevent="imagepath(userFile)" 
                    width="110" 
                    height="110" 
                    rounded 
                    fluid 
                    :src="userFile" 
                    alt="Thumbnail"/>
                </a>
              </template>
              <template v-if="isVideo(checkFileExtention)">
                <video width="200" height="140" controls>
                  <source :src="userFile" type="video/mp4">
                </video>
              </template>
            </template>
            <p>{{message}}</p>
          </div>
        </div>
        <div class="time">
          <p>{{ time }}</p>
        </div>
      </div>
    </template>
    <template v-else>
      <div class="single-chat-area right">
        <div class="chat-box-content">
          <div class="chat-box-text">
            <template v-if="file !== ''">
              <template v-if="isImage(checkFileExtention)">
                <a v-b-modal.showimageModal target="_blank">
                  <br>
                  <b-img
                    @click.prevent="imagepath(userFile)"
                    width="110" 
                    height="110" 
                    rounded 
                    fluid 
                    :src="userFile" 
                    alt="Thumbnail"/>
                </a>
              </template>
              <template v-if="isVideo(checkFileExtention)">
                <video width="200" height="140" controls>
                  <source :src="userFile" type="video/mp4">
                </video>
              </template>
            </template>
            <p>{{message}}</p>
          </div>
          <div class="img-area image">
            &nbsp;
            <img  class="rounded-circle" :src="getProfileImage" alt>
          </div>
        </div>
        <div class="time">
          <p>{{ time }}</p>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
export default {
  props: [
    "message",
    "color",
    "user",
    "side",
    "time",
    "profilepicture",
    "file",
    "fileextension"
  ],
  computed: {
    className() {
      return "list-group-item-" + this.color + " text-" + this.side;
    },
    badgeClass() {
      return "badge-" + this.color;
    },
    getProfileImage() {
      return "../" +this.profilepicture;
    },
    userFile() {
      if(!this.file.search("blob")){
        return this.file;
      }else{
        return "../"+this.file;

      }
    },
    checkFileExtention() {
      return this.fileextension;
    }
  },

  methods: {
    imagepath(path){
      this.$emit("clickedimage", path);
    },
    getExtension(filename) {
      var parts = filename.split(".");
      return parts[parts.length - 1];
    },
    isImage(filename) {
      var ext = this.getExtension(filename);
      switch (ext.toLowerCase()) {
        case "jpeg":
        case "jpg":
        case "png":
        case "gif":
          //etc
          return true;
      }
      return false;
    },
    isVideo(filename) {
      var ext = this.getExtension(filename);
      switch (ext.toLowerCase()) {
        case "webm":
        case "wmv":
        case "mp4":
          // if (filename["size"] <= 10000000) {
          return true;
        // }
      }
      return false;
    }
  },
  mounted() {
    //
  }
};
</script>
<style>
</style>





