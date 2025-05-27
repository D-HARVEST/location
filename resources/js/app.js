import { createApp } from 'vue';
import ContratGenerator from './components/ContratGenerator.vue';

const app = createApp({});
app.component('contrat-generator', ContratGenerator);
app.mount('#app');
