<template>
  <div class="p-usersProfile">
    <div class="p-usersProfile__img" :style="'background-image: url('+userImg+')'"></div>
    <div class="p-usersProfile__name">
      <p>{{User.name}}</p>
    </div>
    <div class="p-usersProfile__comment">
      <p>{{User.comment}}</p>
    </div>
    <div class="p-usersProfile__edit" v-if="IsAuthCheck">
      <a :href="endpoint">編集</a>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    isAuthCheck: {
      type: Boolean
    },
    user: {
      type: Object
    },
    endpoint: {
      type: String
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      IsAuthCheck: this.isAuthCheck,
      User: this.user
    };
  },
  computed: {
    userImg() {
      return this.User.img !== null
        ? "/storage/" + this.User.img
        : "/images/noavatar.png";
    }
  },
  methods: {},
  mounted() {}
};
</script>