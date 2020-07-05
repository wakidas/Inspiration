<template>
  <div class="l-tabs">
    <ul class="p-tabs">
      <li class="p-tabs__item" :class="{'is-active': currentPage === 'index'}">
        <a href="/mypage">マイページ</a>
      </li>
      <li class="p-tabs__item" :class="{'is-active': currentPage === 'bought'}">
        <a href="/mypage/boughts">購入一覧</a>
      </li>
      <li class="p-tabs__item" :class="{'is-active': currentPage === 'likes'}">
        <a href="/mypage/likes">気になる</a>
      </li>
      <li class="p-tabs__item" :class="{'is-active': currentPage === 'myIdeas'}">
        <a href="/mypage/myIdeas">投稿一覧</a>
      </li>
      <li class="p-tabs__item" :class="{'is-active': currentPage === 'reviews'}">
        <a href="/mypage/reviews">レビュー一覧</a>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    currentPage: {
      type: String
    }
  },
  data() {
    return {};
  },
  computed: {},
  methods: {},
  mounted() {}
};
</script>