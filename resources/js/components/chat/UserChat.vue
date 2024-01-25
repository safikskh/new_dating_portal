<template>
  <div class="row">
    <!-- LeftBar Chat -->
    <div class="col-sm-12 col-md-5 col-xl-4">
      <div class="card custom-card">
        <div class="main-content-app chat-content-area pt-0">
          <div class="main-content-left main-content-left-chat">
            <nav class="nav main-nav-line main-nav-line-chat card-body">
              <a
                class="nav-link active"
                style="font-weight: bold"
                data-toggle="tab"
                href="#ChatList"
                >Beskeder</a
              >
            </nav>
            <div class="card-body tab-content h-100">
              <div class="main-chat-list tab-pane active" id="ChatList">
                <user-list
                  :currentUser="reciver"
                  :authUser="sender.id"
                  :textUser.sync="sentUser"
                  :userObj="user"
                  @chatBoxUser="fetchReceiver"
                  v-for="user in users"
                  :key="user.id"
                ></user-list>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Middle Chat -->

    <!-- Rightbar Sidebar -->
    <div v-if="reciver" class="col-sm-12 col-md-7 col-xl-8">
      <div class="card custom-card">
        <div class="main-content-app chat-content-area pt-0">
          <div class="main-content-body main-content-body-chat">
            <div class="main-chat-header pt-3">
              <div class="main-img-user online">
                <img
                  @error="onImageLoadFailure($event)"
                  v-bind:src="reciver.profilePicture"
                />
              </div>
              <div class="main-chat-msg-name">
                <h6>
                  <a
                    style="font-weight: bold; text-transform: capitalize"
                    target="_blank"
                    :href="'profile?user_id=' + reciver.id"
                    v-html="reciver.userName"
                  ></a>
                </h6>
                <!-- <span class="dot-label bg-success"></span>
                <small class="mr-3">{{reciver.status}}</small>-->
              </div>
              <nav class="nav">
                <a
                  class="nav-link"
                  href="#"
                  data-toggle="dropdown"
                  role="button"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="fe fe-more-horizontal"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow">
                  <a
                    class="dropdown-item"
                    type="button"
                    @click.prevent="blockUser(reciver.id)"
                  >
                    <i class="fa fa-ban mr-1"></i> Bloker
                  </a>
                  <a
                    class="dropdown-item"
                    type="button"
                    @click.prevent="favUser(reciver.id)"
                  >
                    <i class="fa fa-heart mr-1"></i>
                    {{ btntext }}
                  </a>
                  <!-- <a class="dropdown-item" type="button">
                    <i class="fe fe-trash-2 mr-1"></i> Slet Denne Samtale
                  </a>-->
                </div>
                <a
                  class="nav-link"
                  type="button"
                  title="Bloker"
                  @click.prevent="blockUser(reciver.id)"
                >
                  <i class="fa fa-ban"></i>
                </a>
                <a
                  class="nav-link"
                  type="button"
                  v-bind:title="btntext"
                  @click.prevent="favUser(reciver.id)"
                >
                  <i class="fa fa-heart"></i>
                </a>
                <!-- <a class="nav-link" type="button" title="Slet Denne Samtale">
                  <i class="fe fe-trash-2"></i>
                </a>-->
              </nav>
            </div>

            <div
              class="chat-conversation p-3 p-lg-4"
              data-simplebar="init"
              style="overflow-y: scroll"
              v-chat-scroll
            >
              <ul class="list-unstyled mb-0">
                <li
                  :class="oldMessage.sender_id === sender.id ? 'right' : ''"
                  v-for="(oldMessage, index) in oldMessages"
                  :key="index"
                >
                  <template v-if="oldMessage.sender_id != sender.id">
                    <div class="conversation-list">
                      <div class="chat-avatar">
                        <img
                          @error="onImageLoadFailure($event)"
                          :src="'/' + reciver.portalInfo.profilePicture"
                        />
                      </div>
                      <div class="user-chat-content">
                        <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                            <p class="mb-0">
                              {{ oldMessage.detail }}
                            </p>
                            <template v-if="oldMessage.file !== ''">
                              <template v-if="isImages(oldMessage.file)">
                                <ul class="list-inline message-img mb-0">
                                  <li class="list-inline-item message-img-list">
                                    <div>
                                      <a
                                        class="popup-img d-inline-block m-1"
                                        :href="oldMessage.file"
                                        :title="oldMessage.detail"
                                      >
                                        <img
                                          :src="oldMessage.file"
                                          class="rounded border"
                                          width="150px"
                                          height="auto"
                                        />
                                      </a>
                                    </div>
                                  </li>
                                </ul>
                              </template>
                              <template v-if="isVideos(oldMessage.file)">
                                <ul class="list-inline message-img mb-0">
                                  <li class="list-inline-item message-img-list">
                                    <div>
                                      <video
                                        class="message-video"
                                        width="150px"
                                        height="auto"
                                        controls
                                      >
                                        <source
                                          :src="oldMessage.file"
                                          type="video/mp4"
                                        />
                                      </video>
                                    </div>
                                  </li>
                                </ul>
                              </template>
                            </template>
                            <p class="chat-time mb-0" style="font-size: 10px">
                              <i class="fa fa-clock align-middle"></i>
                              <span class="align-middle">{{
                                oldMessage.updated_at | formatDateTime
                              }}</span>
                            </p>
                          </div>
                          <!-- <div class="more align-self-start">
                                        <a href="#" role="button"> <i class="fas fa-ellipsis-v fa-2x"></i></a>
                                    </div>-->
                        </div>
                        <div class="conversation-name">
                          {{ reciver.portalInfo.username }}
                        </div>
                      </div>
                    </div>
                  </template>

                  <template v-else>
                    <div class="conversation-list">
                      <div class="chat-avatar">
                        <img
                          @error="onImageLoadFailure($event)"
                          :src="'/' + sender.portalInfo.profilePicture"
                        />
                      </div>
                      <div class="user-chat-content">
                        <div class="ctext-wrap">
                          <div class="ctext-wrap-content">
                            <p class="mb-0">
                              {{ oldMessage.detail }}
                            </p>
                            <template v-if="oldMessage.file !== ''">
                              <template v-if="isImages(oldMessage.file)">
                                <ul class="list-inline message-img mb-0">
                                  <li class="list-inline-item message-img-list">
                                    <div>
                                      <a
                                        class="popup-img d-inline-block m-1"
                                        :href="oldMessage.file"
                                        :title="oldMessage.detail"
                                      >
                                        <img
                                          :src="oldMessage.file"
                                          class="rounded border"
                                          width="150px"
                                          height="auto"
                                        />
                                      </a>
                                    </div>
                                  </li>
                                </ul>
                              </template>
                              <template v-if="isVideos(oldMessage.file)">
                                <ul class="list-inline message-img mb-0">
                                  <li class="list-inline-item message-img-list">
                                    <div>
                                      <video
                                        class="message-video"
                                        width="150px"
                                        height="auto"
                                        controls
                                      >
                                        <source
                                          :src="oldMessage.file"
                                          type="video/mp4"
                                        />
                                      </video>
                                    </div>
                                  </li>
                                </ul>
                              </template>
                            </template>
                            <p class="chat-time mb-0" style="font-size: 10px">
                              <i class="fa fa-clock align-middle"></i>
                              <span class="align-middle">{{
                                oldMessage.updated_at | formatDateTime
                              }}</span>
                            </p>
                          </div>
                          <div class="more align-self-start">
                            <a href="#" role="button">
                              <i class="fas fa-ellipsis-v fa-2x"></i
                            ></a>
                          </div>
                        </div>
                        <div class="conversation-name">
                          {{ sender.portalInfo.username }}
                        </div>
                      </div>
                    </div>
                  </template>
                </li>
              </ul>
            </div>

            <div class="main-chat-footer">
              <nav class="nav">
                <div class="file-upload">
                  <input type="file" id="file" @change="userFile($event)" />
                  <label
                    style="color: #1b4da6; cursor: pointer; padding-top: 8px"
                    class="nav-link"
                    data-toggle="tooltip"
                    title="Del billede"
                    for="file"
                  >
                    <i class="far fa-file-alt fa-2x" type="file"></i>
                  </label>
                </div>
                <!-- <div class="file-upload">
                  <input type="file" id="video" />
                  <label
                    style="color: #1b4da6; cursor: pointer; padding-top: 8px"
                    class="nav-link"
                    data-toggle="tooltip"
                    title="Del video"
                    for="video"
                  >
                    <i class="far fa-play-circle fa-2x" type="file"></i>
                  </label>
                </div> -->
                <!-- <div class="file-upload">
                  <input type="file" id="emoji" />
                  <label
                    style="color: #1b4da6; cursor: pointer; padding-top: 8px"
                    class="nav-link"
                    data-toggle="tooltip"
                    title="Del Emoji"
                    for="emoji"
                  >
                    <i class="far fa-laugh fa-2x" type="file"></i>
                  </label>
                </div> -->
              </nav>

              <!--
              <nav class="nav">
                <a class="nav-link" data-toggle="tooltip" title="Tilføj foto">
                  <i class="fe fe-image"></i>
                </a>
                <a class="nav-link" data-toggle="tooltip" title="Vedhæft en fil">
                  <i class="fe fe-paperclip"></i>
                </a>
                <a class="nav-link" data-toggle="tooltip" href="#" title="Emoji">
                  <i class="far fa-smile"></i>
                </a>
              </nav>
              -->
              <input
                type="text"
                v-on:keyup.enter="sendCheck()"
                name
                v-model="message"
                placeholder="  Skriv her..."
                class="form-control"
              />
              <a
                class="main-msg-send"
                style="
                  color: white;
                  border-radius: 5px;
                  background: #1b4da6;
                  padding: 0px 6px 0px 6px;
                "
                type="submit"
                @click="sendCheck()"
                :disabled="loadingChat"
              >
                <i class="far fa-paper-plane"></i>
              </a>
              <!-- <button class="btn btn-lg" type="submit" @click="sendCheck()" :disabled="loadingChat">
                <i class="fab fa-telegram-plane"></i>
              </button>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Right Sidebar -->
  </div>
</template>

<script>
import axios from "axios";
import UserList from "./UserList";

export default {
  props: ["newmessageuser", "isfavorite"],
  name: "user-chat",
  components: {
    UserList,
  },
  data() {
    return {
      deleteMessageId: "",
      sentUser: {},
      isFavcolor: "",
      btntext: "",
      imagePath: "",
      notification: 0,
      isSeen: false,
      users: [],
      uploadPercentage: 0,
      reciver: {},
      sender: {},
      oldMessages: [],
      message: "",
      file: "",
      filePath: "",
      fileExtention: "",
      loadingChat: false,
      chat: {
        message: [],
        file: [],
        sender_id: [],
        user_id: [],
      },
      /* MOSTOFA */
      session: null,
      videoApikey: "",
      videoSessionId: "",
      videoTokenId: "",
      videoCallerId: "",
      showVModal: false,
      /* MOSTOFA */
    };
  },
  watch: {
    reciver: {
      handler() {
        this.getMessages(this.reciver.id);
      },
      deep: true,
    },
    // message() {
    //   Echo.private("user." + this.sender.id).whisper("type", {
    //     name: this.message
    //   });
    // }
  },
  mounted() {
    this.fetchSender();
    this.fetchUsers(this.newmessageuser);
    this.favBtnBehavior();
  },
  computed: {},
  methods: {
    onImageLoadFailure(event) {
      event.target.src = "/dashlead/img/default/404-dp-sm.png";
    },
    showSingleDeleteModal(messageId) {
      this.deleteMessageId = messageId;
      this.$refs["singleDeleteConfirationModal"].show();
    },
    hideAllDeleteModal() {
      this.$refs["deleteConfirationModal"].hide();
    },
    hideSingleDeleteModal() {
      this.$refs["singleDeleteConfirationModal"].hide();
    },
    checkActiveUser(user) {
      if (this.reciver.id == user.id) {
        return "active";
      }
    },
    imageModel(url) {
      this.imagePath = url;
    },
    blockUser(recever) {
      var formData = new FormData();
      formData.append("block_by", this.sender.id);
      formData.append("block_to", recever);
      if (recever != null) {
        axios
          .post("blockList", formData, {
            headers: {
              "Content-Type": "application/json",
            },
          })
          .then((response) => {
            location.reload();
            this.$toaster.warning("User blocked");
          });
      }
    },

    /* MOSTOFA */

    callUser(caller, recever) {
      if (caller != null && recever != null) {
        this.videoCallerId = caller;
        console.log("caller:" + caller + "|reciver:" + recever);
        this.getVideoData(recever);
        this.getPusherNode();
        this.showVModal = true;
      }
    },
    getVideoData(recever) {
      //var self = this;
      console.log("recever: " + recever);
      axios
        .get("https://tokbox.datingportalen.com/public/chat/" + recever)
        .then(
          function (response) {
            console.log(response);
            this.videoApikey = response.data.apiKey;
            this.videoSessionId = response.data.session;
            this.videoTokenId = response.data.token;
            //this.videoCallerId = response.data.callerId;
          }.bind(this)
        );
    },
    getPusherNode() {
      /*
      console.log(this.videoApikey);      
      console.log(this.videoSessionId);
      console.log(this.videoTokenId);
      console.log(this.videoCallerId);
      */
      Pusher.logToConsole = true;
      var pusher = new Pusher("b0afebfed33ee01f9308", {
        cluster: "mt1",
        encrypted: true,
      });
      var vm = this;
      var channel = pusher.subscribe("my-channel");
      channel
        .bind("my-event", function (data) {
          console.log(data);
          console.log(
            "receiver" + data.callerId + ", caller" + this.videoCallerId
          );
          this.videoApikey = data.apiKey;
          this.videoSessionId = data.session;
          this.videoTokenId = data.token;
          if (data.callerId != this.videoCallerId) {
            vm.initSession();
            $("#videModel").modal("show");
          }
          //alert(JSON.stringify(data));
        })
        .bind(this);
    },
    handleError(error) {
      if (error) {
        alert(error.message);
      }
    },
    initSession() {
      console.log("session init");
      this.session = OT.initSession(this.videoApikey, this.videoSessionId);
      // Subscribe to a newly created stream
      this.session.on("streamCreated", function (event) {
        this.session.subscribe(
          event.stream,
          "subscriber",
          {
            insertMode: "append",
            width: "100%",
            height: "100%",
          },
          this.handleError
        );
      });

      // Create a publisher
      var publisher = OT.initPublisher(
        "publisher",
        {
          insertMode: "append",
          width: "100%",
          height: "100%",
        },
        this.handleError
      );

      // Connect to the session
      this.session.connect(this.videoTokenId, function (error) {
        // If the connection is successful, publish to the session
        if (error) {
          this.handleError(error);
        } else {
          this.session.publish(publisher, this.handleError);
        }
      });
    },
    destroySession() {
      this.session.disconnect();
      this.session = null;
    },
    /* END MOSTOFA */

    deleteAllMessageByUser(recever) {
      var formData = new FormData();
      formData.append("id", recever);
      if (recever != null) {
        axios
          .post("delete_all_messages", formData, {
            headers: {
              "Content-Type": "application/json",
            },
          })
          .then((response) => {
            location.reload();
            this.$toaster.warning("Deleted all conversation");
          });
      }
    },
    deleteMessageById(recever) {
      var formData = new FormData();
      formData.append("user_id", recever);
      formData.append("message_id", this.deleteMessageId);
      if (recever != null && this.deleteMessageId != null) {
        axios
          .post("delete_messages_by_id", formData, {
            headers: {
              "Content-Type": "application/json",
            },
          })
          .then((response) => {
            if (response.data == 1) {
              for (var i = 0; i < this.oldMessages.length; i++) {
                if (this.oldMessages[i].id == this.deleteMessageId) {
                  this.oldMessages.splice(i, 1);
                  this.$refs["singleDeleteConfirationModal"].hide();
                  this.$toaster.warning("Message deleted");
                }
              }
            }
          });
      }
    },
    favBtnBehavior() {
      if (window.location.pathname == "/chat") {
        this.btntext = "Tilføj favorit";
        this.isFavcolor = false;
      } else {
        this.btntext = "Fjern favorit";
        this.isFavcolor = true;
      }
    },
    favUser(recever) {
      var formData = new FormData();
      formData.append("favourite_by", this.sender.id);
      formData.append("favourite_to", recever);
      axios
        .post("favourite", formData, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((response) => {
          if (window.location.pathname == "/chat") {
            window.location = "favchat";
          } else {
            window.location = "chat";
          }
        });
    },
    userFile(file) {
      return file;
    },
    checkFileExtention(filePath) {
      return filePath;
    },
    appendEmoji(emoji) {
      this.message += emoji;
    },
    userFile(event) {
      this.file = event.target.files[0];
      this.filePath = URL.createObjectURL(this.file);
      this.isVideo(this.file);
      // this.isImage(this.file);
    },
    getExtension(filename) {
      if (filename != null) {
        var parts = filename.toString().split(".");
        return parts[parts.length - 1];
      }
    },
    isImage(filename) {
      if (filename != null) {
        var ext = this.getExtension(filename["name"]);
        switch (ext.toLowerCase()) {
          case "jpeg":
          case "jpg":
          case "png":
          case "gif":
            if (filename["size"] <= 10000000) {
              return true;
            } else {
              this.filePath = "";
              this.file = "";
              this.$toaster.warning("Max file limit 10Mb");
            }
        }
        return false;
      }
    },
    isVideo(filename) {
      if (filename != null) {
        var ext = this.getExtension(filename["name"]);
        switch (ext.toLowerCase()) {
          case "webm":
          case "wmv":
          case "mp4":
            if (filename["size"] <= 10000000) {
              this.fileExtention = this.file["name"];
              this.sendMessage();
              return true;
            } else {
              this.filePath = "";
              this.file = "";
              this.$toaster.warning("Max file limit 10Mb");
            }
        }
        return false;
      }
    },
    isImages(filename) {
      if (filename !== null) {
        var ext = this.getExtension(filename);
        switch (ext.toLowerCase()) {
          case "jpeg":
          case "jpg":
          case "png":
          case "gif":
            return true;
        }
        return false;
      } else {
        return false;
      }
    },
    isVideos(filename) {
      if (filename !== null) {
        var ext = this.getExtension(filename);
        switch (ext.toLowerCase()) {
          case "webm":
          case "wmv":
          case "mp4":
            return true;
        }
        return false;
      } else {
        return false;
      }
    },
    sendCheck() {
      if (
        this.message.replace(/\s/g, "").length !== 0 ||
        this.file.length != 0
      ) {
        if (this.file.length != 0) {
          if (this.isImage(this.file) || this.isVideo(this.file)) {
            this.fileExtention = this.file["name"];
            this.sendMessage();
          } else {
            this.file = "";
            this.filePath = "";
            this.$toaster.warning("File not supported");
          }
        } else {
          this.fileExtention = "file.xyz";
          this.sendMessage();
        }
      }
    },
    sendMessage() {
      this.loadingChat = true;
      var formData = new FormData();
      formData.append("user_id", this.reciver.id);
      formData.append("file", this.file);
      formData.append("message", this.message);
      formData.append("send", "free");

      axios
        .post("user_chat", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
          onUploadProgress: function (progressEvent) {
            this.uploadPercentage = parseInt(
              Math.round((progressEvent.loaded * 100) / progressEvent.total)
            );
          }.bind(this),
        })
        .then((response) => {
          this.uploadPercentage = 0;
          this.filePath = "";
          this.file = "";
          this.message = "";
          this.loadingChat = false;
          this.oldMessages.push(response.data);

          const prevResponse = response;

          axios
            .get("/read_messages/" + this.reciver.id)
            .then((response) => {
              if (
                prevResponse.data.hasOwnProperty("negative_matchwords") &&
                prevResponse.data.negative_matchwords.length > 0
              ) {
                const tContent = this.tooltipText(
                  this.reciver,
                  prevResponse.data.negative_matchwords
                );
                console.log("Now trigger tooltip");
                $("#" + this.reciver.id).tooltip({
                  content: tContent,
                });
                $("#" + this.reciver.id).tooltip("open");
              }
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          console.log(error.response);
        });
      this.sentUser = {
        user_id: this.reciver.id,
      };
      this.$root.$emit("callNotifComponent", this.reciver);
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
    regionCheck(data) {
      if (data != null) {
        return data;
      } else {
        return "";
      }
    },
    tooltipText(user, negative_matchwords) {
      var matchwords = negative_matchwords.join(", ");

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
        this.strReplace(JSON.parse(user.portalInfo.matchWords)) +
        "\n Negative Matchord: " +
        matchwords
      );
    },
    getMessages(id) {
      axios.get("user_messages/" + id).then((response) => {
        this.oldMessages = response.data;
      });
    },
    fetchReceiver(user) {
      this.reciver = user;
    },
    fetchUsers(id) {
      let userIndex;
      axios
        .get("chat_users", {
          params: {
            isFav: this.isfavorite,
          },
        })
        .then((response) => {
          this.users = response.data;
          this.users.forEach(function (user, index) {
            if (user.id === id) {
              userIndex = index;
            } else {
              userIndex = 0;
            }
          });
          this.fetchReceiver(this.users[userIndex]);
        });
    },
    fetchSender() {
      axios.get("get_auth").then((response) => {
        this.sender = response.data;
        this.listenForNewMessage();
      });
    },
    listenForNewMessage() {
      var d = new Date();
      Echo.private("user." + this.sender.id).listen(".user.chat", (e) => {
        if (
          this.reciver.id === e.user &&
          this.reciver.portalInfo.portal_id == e.portal_id
        ) {
          this.notification += 1;
          this.oldMessages.push({
            detail: e.message,
            file: e.file,
            sender_id: e.user,
            user_id: this.sender.id,
            portal_id: e.portal_id,
            updated_at: d,
          });
        }
      });
    },
  },
};
</script>

<style>
.message-video {
  padding: "5px";
}
/* Mostofa */
@media (min-width: 576px) {
  .modal-dialog {
    max-width: none;
  }
}

.modal-dialog {
  width: 98%;
  height: 92%;
  padding: 0;
}

.modal-content {
  height: 99%;
}

#videos {
  position: relative;
  width: 100%;
  height: 100%;
  margin-left: auto;
  margin-right: auto;
}

#subscriber {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  z-index: 10;
}

#publisher {
  position: absolute;
  width: 360px;
  height: 240px;
  bottom: 10px;
  left: 10px;
  z-index: 100;
  border: 3px solid white;
  border-radius: 3px;
}
/* end Mostofa */
</style>
