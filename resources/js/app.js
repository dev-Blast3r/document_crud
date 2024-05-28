import { createApp } from 'vue';
import App from './App.vue';
import { Form, Field, ErrorMessage, defineRule, configure } from 'vee-validate';
import { required, min, max } from '@vee-validate/rules';
import { localize } from '@vee-validate/i18n';
import es from '@vee-validate/i18n/dist/locale/es.json';
import router from './router'; // Importar la configuración de Vue Router

// Definir reglas de validación
defineRule('required', required);
defineRule('min', min);
defineRule('max', max);

// Configurar localización en español
configure({
  generateMessage: localize({ es }),
  validateOnInput: true,
});

const app = createApp(App);

// Registrar componentes globalmente
app.component('VForm', Form);
app.component('VField', Field);
app.component('ErrorMessage', ErrorMessage);

app.use(router); // Usar Vue Router

app.mount('#app');
