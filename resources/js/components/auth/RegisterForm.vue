<template>
  <div class="c-auth">
    <div class="c-auth__logo">
      <a href="/" class="c-auth__logo__link">
        <img src="/images/logo.png" alt="Inspiration" />
      </a>
    </div>
    <div class="c-auth__inner">
      <div class="c-auth__title">新規登録</div>
      <div class="c-auth__form">
        <form method="POST" :action="endpointLogin">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- メールアドレス -->
          <div class="c-auth__formGroup">
            <label for="email" class="c-auth__formLabel">
              メールアドレス
              <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="email"
                type="email"
                class="c-auth__formInput"
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

          <!-- パスワード -->
          <div class="c-auth__formGroup">
            <label for="password" class="c-auth__formLabel">
              パスワード
              <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="password"
                type="password"
                class="c-auth__formInput"
                name="password"
                v-model="password"
                required
                autocomplete="current-password"
              />
              <span class="c-error" role="alert" v-for="value in error.password" :key="value.id">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- パスワード 再入力 -->
          <div class="c-auth__formGroup">
            <label for="password" class="c-auth__formLabel">
              パスワード（再入力）
              <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="password"
                type="password"
                class="c-auth__formInput"
                name="password-confirm"
                v-model="passwordConfirm"
                required
              />
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="c-auth__submit">
            <button type="submit" class="c-button__submit">登録する</button>
          </div>

          <!-- ログイン画面への導線 -->
          <div class="c-auth__toLogin">
            ログインは
            <a class="c-auth__toLogin__link" href="/login">こちら</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["old", "errors", "endpointLogin", "endpointRequest"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      email: this.old.email,
      password: "",
      passwordConfirm: "",
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
