import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Visitor from './pages/Visitor.vue';
import Admin from './pages/Admin.vue';
import VueHighlightJS from 'vue3-highlightjs'
import 'highlight.js/styles/atelier-dune-dark.css'

const app=createApp({})

app.use(VueHighlightJS)
app.component("Visitor",Visitor);
app.component("Admin",Admin);

app.mount('#app');

