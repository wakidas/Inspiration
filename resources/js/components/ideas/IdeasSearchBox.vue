<template>
  <section class="p-ideas__searchBox">
    <div class="p-ideas__search p-ideas__search--category">
      <!-- カテゴリー -->
      <div class="p-ideas__search__title">カテゴリー</div>
      <div class="p-ideas__searchBox__body">
        <div
          class="p-ideas__searchBox__category"
          v-for="categorie in categories"
          :key="categorie.id"
        >
          <input
            :id="'category['+categorie.id+']'"
            type="checkbox"
            class="p-ideas__searchBox__check"
            name
            value
          />
          <label class="p-ideas__searchBox__label" :for="'category['+categorie.id+']'">
            <span>{{categorie.name}}</span>
          </label>
        </div>
      </div>
    </div>
    <div class="p-ideas__search__bottom">
      <!-- 価格 -->
      <div class="p-ideas__search p-ideas__search--price">
        <div class="p-ideas__search__title">価格</div>
        <div class="p-ideas__search__price">
          <input class="p-ideas__search__price__input" type="number" />
          <span>~</span>
          <input class="p-ideas__search__price__input" type="number" />
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
          input-class="vuejs-datepicker__input"></vuejs-datepicker>
          <span>~</span>
          <vuejs-datepicker
          class="p-ideas__search__date__input"
          :format="DatePickerFormat"
          :language="ja"
          input-class="vuejs-datepicker__input"
          calendar-class="vuejs-datepicker__calendar"></vuejs-datepicker>
        </div>
      </div>
      <!-- 検索ボタン -->
        <div class="p-ideas__searchBox__submit">
          <button type="submit" class="c-button__submit">検索</button>
        </div>
    </div>
  </section>
</template>
<style lang="css">
.vuejs-datepicker__input{
    width: 100%;
    padding: 8px;
}
.vuejs-datepicker__calendar{
    right: 0;
}
</style>

<script>
import VuejsDatepicker from "vuejs-datepicker";
import {ja} from 'vuejs-datepicker/dist/locale'

export default {
  components: {
    VuejsDatepicker
  },
  props: {
    categories: {
      type: Array
    }
  },
  data() {
    return {
      Categories: this.categories,
      DatePickerFormat: 'yyyy-MM-dd',
      ja:ja,
    };
  }
};
</script>