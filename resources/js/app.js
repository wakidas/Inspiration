/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import jquery from "jquery";
window.$ = jquery;

import LoginForm from "./components/LoginForm";

require('./components/footerFixed');
require('./components/drawerMenu');

window.Vue = require('vue');



//vueコンポーネントを使用する
const app = new Vue({
    el: "#app",
    components: {
       LoginForm
    }
});