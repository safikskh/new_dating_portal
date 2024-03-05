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
                >Chatrum</a
              >
              <a
                class="nav-link"
                style="font-weight: bold"
                data-toggle="tab"
                href="#onlineusers"
                >Online - {{ numberOfUsers }}</a
              >
            </nav>
            <div class="card-body tab-content h-100">
              <div class="main-chat-list tab-pane active" id="ChatList">
                <a
                  :href="'/chat-rooms/' + croom.id"
                  v-for="(croom, index) in chatroomlist"
                  :key="index"
                >
                  <div
                    class="media"
                    :class="croom.id === room.id ? 'selected' : ''"
                  >
                    <div class="main-img-user online">
                      <img
                        @error="onImageLoadFailure($event)"
                        v-bind:src="'/' + croom.chatroom_image"
                      />
                    </div>
                    <div class="media-body">
                      <div class="media-contact-name">
                        <span
                          style="font-weight: bold; text-transform: capitalize"
                          >{{ croom.chatroom_name }}</span
                        >
                      </div>
                      <p>
                        <span class="text-danger" style="font-weight: bold"
                          >Kun for betalt bruger</span
                        >
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              <div class="main-chat-list tab-pane" id="onlineusers">
                <a
                  :href="'/profile?user_id=' + user.id"
                  v-for="(user, index) in users"
                  :key="index"
                >
                  <div class="media">
                    <div class="main-img-user online">
                      <img
                        @error="onImageLoadFailure($event)"
                        v-bind:src="'/' + user.portalInfo.profilePicture"
                      />
                    </div>
                    <div class="media-body">
                      <div class="media-contact-name">
                        <span
                          style="font-weight: bold; text-transform: capitalize"
                          >{{ user.portalInfo.username }}</span
                        >
                      </div>
                      <p>
                        <span class="badge badge-light">{{
                          user.portalInfo.regionName
                        }}</span>
                      </p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Middle Chat -->

    <!-- Rightbar Sidebar -->
    <div class="col-sm-12 col-md-7 col-xl-8">
      <div class="card custom-card">
        <div class="main-content-app chat-content-area pt-0">
          <div class="main-content-body main-content-body-chat">
            <div class="main-chat-header pt-3">
              <div class="main-img-user online">
                <img
                  @error="onImageLoadFailure($event)"
                  v-bind:src="'/' + room.chatroom_image"
                />
              </div>
              <div class="main-chat-msg-name">
                <h6>{{ room.chatroom_name }}</h6>
                <span class="dot-label bg-success"></span>
                <small class="mr-3">{{ numberOfUsers }} Bruger Online</small>
              </div>
            </div>

            <div
              class="chat-conversation p-3 p-lg-4"
              data-simplebar="init"
              style="overflow-y: scroll"
              v-chat-scroll
            >
              <ul class="list-unstyled mb-0">
                <li
                  :class="message.user.id === user.id ? 'right' : ''"
                  v-for="(message, index) in messages"
                  :key="index"
                >
                  <div class="conversation-list">
                    <div class="chat-avatar">
                      <img
                        @error="onImageLoadFailure($event)"
                        :src="'/' + message.user.portalInfo.profilePicture"
                      />
                    </div>
                    <div class="user-chat-content">
                      <div class="ctext-wrap">
                        <div class="ctext-wrap-content">
                          <p class="mb-0">
                            {{ message.message }}
                          </p>
                          <p class="chat-time mb-0" style="font-size: 10px">
                            <i class="fa fa-clock align-middle"></i>
                            <span class="align-middle">{{
                              message.created_at | moment("Do MMM YY, H:mm")
                            }}</span>
                          </p>
                        </div>
                        <!-- <div class="more align-self-start">
                                    <a href="#" role="button"> <i class="fas fa-ellipsis-v fa-2x"></i></a>
                                </div>-->
                      </div>
                      <div class="conversation-name">
                        {{ message.user.portalInfo.username }}
                      </div>
                    </div>
                  </div>
                </li>
                <!-- 
				<li v-if="activeUser">
                    <div class="conversation-list">
                        <div class="chat-avatar">
                            <img @error="onImageLoadFailure($event)" :src="'/' + activeUser.portalInfo.profilePicture" />
                        </div>
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    <p class="mb-0">
                                        maskinskrivning
                                        <span class="animate-typing">
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                            <span class="dot"></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="conversation-name">{{ activeUser.portalInfo.username }}</div>
                        </div>
                    </div>
                </li>

                -->
              </ul>
            </div>

            <span class="text-muted" v-if="activeUser">
              {{ activeUser.portalInfo.username }} skriver...</span
            >
            <div class="main-chat-footer">
              <input
                @keydown="sendTypingEvent"
                @keyup.enter="sendMessage"
                v-model="newMessage"
                type="text"
                name="message"
                placeholder="Indtast din besked..."
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
                @click.prevent="sendMessage()"
              >
                <i class="fas fa-paper-plane"></i>
              </a>
              <!-- <button class="btn btn-lg" type="submit" @click.prevent="sendMessage()">
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
export default {
  props: ["user", "room", "chatroomlist"],
  data() {
    return {
      messages: [],
      newMessage: "",
      users: [],
      cr_id: this.room.id,
      activeUser: false,
      typingTimer: false,
      numberOfUsers: 0,
    };
  },
  created() {
    this.fetchMessages();
    Echo.join("chatroom." + this.room.id)
      .here((user) => {
        this.users = user;
        this.numberOfUsers = user.length;
      })
      .joining((user) => {
        this.users.push(user);
        this.numberOfUsers += 1;
      })
      .leaving((user) => {
        this.users = this.users.filter((u) => u.id != user.id);
        this.numberOfUsers -= 1;
      })
      .listen("ChatRoomEvent", (event) => {
        this.messages.push(event.chat);
      })
      .listenForWhisper("typing", (user) => {
        this.activeUser = user;
        if (this.typingTimer) {
          clearTimeout(this.typingTimer);
        }
        this.typingTimer = setTimeout(() => {
          this.activeUser = false;
        }, 1000);
      });
  },
  methods: {
    fetchMessages() {
      axios.get("messages/" + this.room.id).then((response) => {
        this.messages = response.data;
      });
    },
    sendMessage() {
      if (this.newMessage.length != 0) {
        this.messages.push({
          user: this.user,
          room_id: this.room.id,
          message: this.newMessage,
          created_at: this.getTime(),
        });
        axios.post("messages", {
          message: this.newMessage,
          room_id: this.room.id,
        });
        this.newMessage = "";
      }
    },
    getTime() {
      let time = new Date();
      // return time.getFullYear() + "-" + time.getMonth() + "-" + time.getDate() + "T" + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
      return (
        time.toISOString().split("T")[0] +
        " " +
        time.toTimeString().split(" ")[0]
      );
    },
    sendTypingEvent() {
      Echo.join("chatroom." + this.room.id).whisper("typing", this.user);
      console.log(this.user.portalInfo.username + " is typing now");
    },
  },
};
</script> 