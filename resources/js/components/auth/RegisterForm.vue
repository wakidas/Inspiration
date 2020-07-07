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
        <form id="form" method="POST" :action="endpointRegiter">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- ユーザー名 -->
          <div class="c-auth__formGroup js-validTarget">
            <label for="email" class="c-auth__formLabel">
              ユーザー名
              <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="name"
                type="name"
                class="c-auth__formInput"
                name="name"
                v-model="name"
                required
                autocomplete="name"
              />

              <span class="c-error" role="alert" v-for="value in error.email" :key="value.email">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>
          <!-- メールアドレス -->
          <div class="c-auth__formGroup js-validTarget">
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
                email
                autocomplete="email"
              />

              <span class="c-error" role="alert" v-for="value in error.email" :key="value.email">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- パスワード -->
          <div class="c-auth__formGroup js-validTarget">
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
          <div class="c-auth__formGroup js-validTarget">
            <label for="password_confirm" class="c-auth__formLabel">
              パスワード（再入力）
              <span class="c-icon__formLabel c-icon__formLabel--required">必須</span>
            </label>
            <div class="c-auth__formItem">
              <input
                id="password_confirm"
                type="password"
                class="c-auth__formInput"
                name="password_confirmation"
                v-model="password_confirmation"
                required
                equalTo="#password"
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
  props: ["old", "errors", "endpointRegiter", "endpointRequest"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      name: this.old.name,
      email: this.old.email,
      password: "",
      password_confirmation: "",
      error: {
        email: this.errors.email,
        password: this.errors.password
      }
    };
  }
};
</script>
