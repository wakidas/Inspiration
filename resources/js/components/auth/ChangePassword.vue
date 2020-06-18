<template>
  <div class="p-changeEmail">
    <div class="p-changeEmail__inner">
      <div class="p-changeEmail__title">パスワード変更</div>

      <div class="p-changeEmail__form">
        <form method="POST" :action="endpoint">
          <input type="hidden" name="_token" :value="csrf" />

          <!-- 現在のパスワード -->
          <div class="p-changeEmail__formGroup">
            <label for="current" class>現在のパスワード</label>
            <div class="p-changeEmail__formItem">
              <input
                id="current"
                type="password"
                class="p-changeEmail__formInput"
                name="current-password"
                v-model="currentPassword"
                required
              />

              <span
                class="c-error"
                role="alert"
                v-for="value in error.currentPassword"
                :key="value.currentPassword"
              >
                <strong>{{ value }}</strong>
              </span>
            </div>
          </div>

          <!-- 新しいパスワード　-->
          <div class="p-changeEmail__formGroup">
            <label for="password" class>新しいパスワード</label>
            <div class="p-changeEmail__formItem">
              <input
                id="password"
                type="password"
                class="p-changeEmail__formInput"
                name="new-password"
                v-model="newPassword"
                required
                placeholder="半角英数字8文字以上"
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
          <div class="p-changeEmail__formGroup">
            <label for="confirm" class>新しいパスワード（再入力）</label>
            <div class="p-changeEmail__formItem">
              <input
                id="confirm"
                type="password"
                class="p-changeEmail__formInput"
                name="new-password_confirmation"
                v-model="newPasswordConfirmation"
                required
                placeholder="半角英数字8文字以上"
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
          <div class="p-changeEmail__submit">
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
      currentPassword: "",
      newPassword: "",
      newPasswordConfirmation: "",
      error: {
        new_email: this.errors.new_email
      }
    };
  }
};
</script>
