<template>
  <form :action="endpoint" method="POST">
    <input type="hidden" name="_token" :value="csrf" />
    <div class="p-ideas__search p-ideas__search--category">
      <!-- カテゴリー -->
      <div class="p-ideas__search__title">カテゴリー</div>
      <div class="p-ideas__searchBox__body">
        <div class="p-ideas__searchBox__category" v-for="category in categories" :key="category.id">
          <input
            :id="'category['+category.id+']'"
            type="checkbox"
            :checked="postData.category.includes(String(category.id))"
            class="p-ideas__searchBox__check"
            name="category[]"
            :value="category.id"
          />
          <label class="p-ideas__searchBox__label" :for="'category['+category.id+']'">
            <span>{{category.name}}</span>
          </label>
        </div>
      </div>
    </div>
    <div class="p-ideas__search__priceDate">
      <!-- 価格 -->
      <div class="p-ideas__search p-ideas__search--price">
        <div class="p-ideas__search__title">価格</div>
        <div class="p-ideas__search__price">
          <input
            class="p-ideas__search__price__input"
            type="number"
            name="price[from]"
            :value="postData.price.from"
            placeholder="下限"
          />
          <span>~</span>
          <input
            class="p-ideas__search__price__input"
            type="number"
            name="price[untill]"
            v-model="postData.price.untill"
            placeholder="上限"
          />
        </div>
      </div>
      <!-- 投稿日 -->
      <div class="p-ideas__search p-ideas__search--date">
        <div class="p-ideas__search__title">投稿日</div>
        <div class="p-ideas__search__date">
          <vuejs-datepicker
            class="p-ideas__search__date__input"
            :format="DatePickerFormat"
            :language="ja"
            input-class="vuejs-datepicker__input"
            name="date[from]"
            v-model="postData.date.from"
            placeholder="開始日"
          ></vuejs-datepicker>
          <span>~</span>
          <vuejs-datepicker
            class="p-ideas__search__date__input"
            :format="DatePickerFormat"
            :language="ja"
            input-class="vuejs-datepicker__input"
            calendar-class="vuejs-datepicker__calendar"
            name="date[untill]"
            v-model="postData.date.untill"
            placeholder="終了日"
          ></vuejs-datepicker>
        </div>
      </div>
    </div>
    <!-- 検索ボタン -->
    <div class="p-ideas__searchBox__submit">
      <button type="submit" class="c-button__submit">検索</button>
    </div>
  </form>
</template>
<style lang="css">
.vuejs-datepicker__input {
  width: 100%;
  padding: 8px;
}
.vuejs-datepicker__calendar {
  right: 0;
}
</style>

<script>
import VuejsDatepicker from "vuejs-datepicker";
import { ja } from "vuejs-datepicker/dist/locale";

export default {
  components: {
    VuejsDatepicker
  },
  props: {
    categories: {
      type: Array
    },
    endpoint: {
      type: String
    },
    postData: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      Categories: this.categories,
      DatePickerFormat: "yyyy-MM-dd",
      ja: ja
    };
  },
  methods: {
    setBodyHeight() {
      $(function() {
        if ($(".js-ideaCard").length === 0) {
          let $footer = $("#footer");
          let $app = $("#app");
          let $list = $("#js-ideas-list");

          let windowHeight = $(window).innerHeight();
          let appHeight = $app.innerHeight();
          let footerHeight = $footer.innerHeight();

          $list.height(windowHeight - appHeight - footerHeight);
        }
      });
    }
  },
  created() {
    this.setBodyHeight();
  }
};
</script>