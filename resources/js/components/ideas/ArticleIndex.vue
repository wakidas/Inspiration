<template>
  <div class="p-ideas">
    <section class="p-ideas__searchBox">
      <div class="p-ideas__search p-ideas__search--category">
        <div class="p-ideas__search__title">カテゴリー</div>
        <div class="p-ideas__searchBox__body">
          <input id="category1" type="checkbox" class="p-ideas__searchBox__check" name value />
          <label class="p-ideas__searchBox__label" for="category1">
            <span>カテゴリー名</span>
          </label>
          <input id="category2" type="checkbox" class="p-ideas__searchBox__check" name value />
          <label class="p-ideas__searchBox__label" for="category2">
            <span>カテゴリー名</span>
          </label>
          <input id="category3" type="checkbox" class="p-ideas__searchBox__check" name value />
          <label class="p-ideas__searchBox__label" for="category3">
            <span>カテゴリー名</span>
          </label>
          <input id="category4" type="checkbox" class="p-ideas__searchBox__check" name value />
          <label class="p-ideas__searchBox__label" for="category4">
            <span>カテゴリー名</span>
          </label>
          <input id="category5" type="checkbox" class="p-ideas__searchBox__check" name value />
          <label class="p-ideas__searchBox__label" for="category5">
            <span>カテゴリー名</span>
          </label>
        </div>
      </div>
      <div class="p-ideas__search__bottom">
        <div class="p-ideas__search p-ideas__search--price">
          <div class="p-ideas__search__title">価格</div>
          <div class="p-ideas__search__price">
            <input class="p-ideas__search__price__input" type="number" />
            <span>~</span>
            <input class="p-ideas__search__price__input" type="number" />
          </div>
        </div>
        <div class="p-ideas__search p-ideas__search--date">
          <div class="p-ideas__search__title">投稿日</div>
          <input class="p-ideas__search__date__input" type="number" />
          <span>~</span>
          <input class="p-ideas__search__date__input" type="number" />
        </div>
      </div>
    </section>
    <section class="p-ideaList"></section>
  </div>
</template>
<script>
export default {};
</script>