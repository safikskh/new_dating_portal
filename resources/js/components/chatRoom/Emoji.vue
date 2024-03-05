<template>
      <emoji-picker  :search="search">
        <div
        class="absolute pin-t pin-r p-2 cursor-pointer emoji-invoker outline-none"
        slot="emoji-invoker"
        slot-scope="{ events: { click: clickEvent } }"
        @click.stop="clickEvent"
      >
          <i class="zmdi zmdi-mood"></i>
        </div>
        <div slot="emoji-picker" slot-scope="{ emojis, insert, display}">
          <div class="emoji-picker" style="bottom: 50px; left: 0px">
            <div class="emoji-picker__search">
              <input type="text" v-model="search" v-focus>
            </div>
            <div>
              <div v-for="(emojiGroup, category) in emojis" :key="category">
                <h5>{{ category }}</h5>
                <div class="emojis">
                  <span
                    v-for="(emoji, emojiName) in emojiGroup"
                    :key="emojiName"
                    @click="append(emoji)"
                    :title="emojiName"
                  >{{ emoji }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </emoji-picker>
</template>
<script>
export default {
  
  data() {
    return {
      // input: '',
      search: ""
    };
  },
  methods: {
    append(emoji) {
      this.$emit("clicked", emoji);
    }
  },
  directives: {
    focus: {
      inserted(el) {
        el.focus();
      },
    },
  }
};
</script>