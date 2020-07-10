<template>
  <div class="p-mypage__ideas__item">
    <div class="p-mypage__ideas__spHalfTop">
      <div class="p-mypage__ideas__ideaImg">
        <img :src="ideaImg" alt />
      </div>
      <div class="p-mypage__ideas__center">
        <div class="p-mypage__ideas__ideaTitle">{{ idea.title}}</div>
        <div class="p-mypage__ideas__ideaDescription">{{ idea.description}}</div>
        <div class="p-mypage__ideas__user">
          <div class="p-mypage__ideas__userImg">
            <img :src="userImg" alt />
          </div>
          <div class="p-mypage__ideas__userName">{{ user.name}}</div>
        </div>
      </div>
    </div>
    <div class="p-mypage__ideas__spHalfBottom">
      <div
        class="p-mypage__ideas__buttons"
        :class="{
          'p-mypage__ideas__buttons--likes' : type === 'likes',
          'p-mypage__ideas__buttons--myideas' : type === 'myIdeas'
          }"
      >
        <div class="p-mypage__ideas__button">
          <a :href="endpoint">詳細を見る</a>
        </div>
        <div
          class="p-mypage__ideas__button p-mypage__ideas__button--unlike"
          v-if="type === 'likes'"
        >
          <a href="javascript:void(0)" @click="unlike">気になるを解除する</a>
        </div>
        <div
          class="p-mypage__ideas__button p-mypage__ideas__button--myIdeas"
          v-if="type === 'myIdeas'"
        >
          <a :href="endpointEdit">編集する</a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  props: {
    idea: {
      type: Object
    },
    user: {
      type: Object
    },
    endpoint: {
      type: String
    },
    endpointLike: {
      type: String
    },
    type: {
      type: String
    }
  },
  data() {
    return {};
  },
  computed: {
    userImg() {
      return this.user.img !== null
        ? "/storage/" + this.user.img
        : "/images/noavatar.png";
    },
    ideaImg() {
      return this.idea.img !== null
        ? "/storage/" + this.idea.img
        : "/images/noimage.png";
    },
    endpointEdit() {
      return "/ideas/" + this.idea.id + "/edit";
    }
  },
  methods: {
    async unlike() {
      const response = await axios.delete(this.endpointLike);
      this.$destroy();
      this.$el.parentNode.removeChild(this.$el);
    }
  },
  mounted() {}
};
</script>