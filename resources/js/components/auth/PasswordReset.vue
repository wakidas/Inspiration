<template>
  <div class="c-auth">
    <div class="c-auth__inner">
      <div class="c-auth__title">パスワードをリセットする</div>

      <div class="c-auth__form">
        <form id="form" method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />
          <input type="hidden" name="token" :value="propsToken" />
          <!-- メールアドレス -->
          <div class="c-auth__formGroup js-validTarget">
            <label for="current" class>メールアドレス</label>
            <div class="c-auth__formItem">
              <input
                id="current"
                type="email"
                class="c-auth__formInput"
                name="email"
                v-model="email"
                required
              />

              <span class="c-error" role="alert" v-for="value in error.email" :key="value.email">
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 新しいパスワード　-->
          <div class="c-auth__formGroup js-validTarget">
            <label for="password" class>新しいパスワード</label>
            <div class="c-auth__formItem">
              <input
                id="password"
                type="password"
                class="c-auth__formInput"
                name="password"
                v-model="password"
                required
              />

              <span
                class="c-error"
                role="alert"
                v-for="value in error.newPassword"
                :key="value.newPassword"
              >
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 新しいパスワード 確認　-->
          <div class="c-auth__formGroup js-validTarget">
            <label for="password_confirmation" class>新しいパスワード（再入力）</label>
            <div class="c-auth__formItem">
              <input
                id="confirm"
                type="password"
                class="c-auth__formInput"
                name="password_confirmation"
                v-model="passwordConfirmation"
                required
                equalTo="#password"
              />

              <span
                class="c-error"
                role="alert"
                v-for="value in error.newPasswordConfirmation"
                :key="value.newPasswordConfirmation"
              >
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 送信ボタン -->
          <div class="c-auth__submit">
            <button type="submit" class="c-button__submit">パスワードを設定</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["old", "errors", "endpoint", "token"],
  data: function() {
    return {
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      propsToken: this.token,
      email: this.old.email ? this.old.email : "",
      password: this.old.password ? this.old.password : "",
      passwordConfirmation: this.old.passwordConfirmation
        ? this.old.passwordConfirmation
        : "",
      error: {
        email: this.errors.email,
        password: this.errors.password,
        passwordConfirmation: this.errors.passwordConfirmation
      }
    };
  }
};
</script>
