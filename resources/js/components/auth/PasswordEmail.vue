<template>
  <div class="c-auth">
    <div class="c-auth__inner">
      <div class="c-auth__title">パスワードをリセットする</div>
      <div class="c-auth__form">
        <form method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="c-auth__formGroup">
            <label for="email" class>メールアドレス</label>
            <div class="c-auth__formItem">
              <input
                id="email"
                type="email"
                class="c-auth__formInput @error('email') is-invalid @enderror"
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
          <div class="c-auth__submit">
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
