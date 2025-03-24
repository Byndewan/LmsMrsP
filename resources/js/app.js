import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import SendMessage from './components/SendMessage.vue';
import ChatMessage from './components/ChatMessage.vue';
import SearchCourse from './components/searchCourse.vue';

import Alpine from 'alpinejs';

// Inisialisasi Vue
const app = createApp({});
app.component('send-message', SendMessage);
app.component('chat-message', ChatMessage);
app.component('search-course', SearchCourse);

// Mount Vue ke #app
app.mount("#app");

// Inisialisasi Alpine.js
window.Alpine = Alpine;
Alpine.start();

