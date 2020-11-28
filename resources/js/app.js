import { createApp } from 'vue';
import App from './components/App.vue';
import Example from './components/Example.vue';

const app = createApp(App)
app.component('hello-world', Example)
app.mount("#app")

require('./bootstrap');