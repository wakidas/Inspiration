<template>
  <div class="p-settings">
    <div class="p-settings__inner">
      <div class="p-settings__title">アカウント設定</div>
      <ul class="p-settings__items">
        <li class="p-settings__list p-settings__list--img">
          <div class="p-settings__imgWrap" :style="'background-image: url('+userImg+')'"></div>
          <a
            :href="endpointToUsersEdit"
            class="c-link__settings__toEdit c-link__settings__toEdit--img"
          >変更</a>
        </li>
        <li class="p-settings__list p-settings__list--name">
          <label class="p-settings__label">
            名前
            <a :href="endpointToUsersEdit" class="c-link__settings__toEdit">変更</a>
          </label>
          <p class="p-settings__text">{{ User.name }}</p>
        </li>
        <li class="p-settings__list p-settings__list--comment">
          <label class="p-settings__label">
            自己紹介
            <a :href="endpointToUsersEdit" class="c-link__settings__toEdit">変更</a>
          </label>
          <p class="p-settings__text">{{ User.comment }}</p>
        </li>
        <li class="p-settings__list p-settings__list--email">
          <label class="p-settings__label">
            メールアドレス
            <a href="/changeEmail" class="c-link__settings__toEdit">変更</a>
          </label>
          <p class="p-settings__text">{{ User.email }}</p>
        </li>
        <li class="p-settings__list p-settings__list--password">
          <label class="p-settings__label">
            パスワード
            <a href="/changepassword" class="c-link__settings__toEdit">変更</a>
          </label>
          <p class="p-settings__text">**********</p>
        </li>
        <li class="p-settings__list p-settings__list--withdraw">
          <a href="/users/delete/confirm" class="c-settings__withdraw">退会する</a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    user: {
      type: Object
    }
  },
  data() {
    return {
      User: this.user
    };
  },
  computed: {
    userImg() {
      return this.User.img !== null
        ? "/storage/" + this.User.img
        : "/images/noavatar.png";
    },
    endpointToUsersEdit() {
      return "/users/" + this.User.id + "/edit";
    },
    endpointToWithdraw() {
      return "/users/" + this.User.id + "/delete/confirm";
    }
  },
  methods: {},
  mounted() {}
};
</script>