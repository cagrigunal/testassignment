import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Visitor from './pages/Visitor.vue';
import Admin from './pages/Admin.vue';

const app=createApp({})

app.component("Visitor",Visitor);
app.component("Admin",Admin);

app.mount('#app');

