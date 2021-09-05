require('./bootstrap');

import Vue from 'vue/dist/vue'
window.Vue = Vue

//Requiring vue-kompo after Vue has been set
require('vue-kompo');
//require('kompo-ckeditor'); //add any optional kompo plugins here

//Booting Vue
const app = new Vue({ el: '#app' });