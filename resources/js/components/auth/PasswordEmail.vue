<template>
  <div class="p-passwordEmail">
    <div class="p-passwordEmail__inner">
      <div class="p-passwordEmail__title">パスワードをリセットする</div>
      <div class="p-passwordEmail__form">
        <form method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="p-passwordEmail__formGroup">
            <label for="email" class>メールアドレス</label>
            <div class="p-passwordEmail__formItem">
              <input
                id="email"
                type="email"
                class="p-passwordEmail__formInput @error('email') is-invalid @enderror"
                name="email"
                v-model="email"
                required
                autocomplete="email"
              />

              <span class="c-error" role="alert" v-for="value in error.email" :key="value.email">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="p-passwordEmail__submit">
            <button type="submit" class="c-button__submit">メール送信</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["old", "errors", "endpoint"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      email: this.old.email,
      password: "",
      remember: this.old.remember,
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
