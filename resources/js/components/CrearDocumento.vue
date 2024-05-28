<template>
  <div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Crear Documento</h1>
    <VForm @submit="guardarDocumento" class="max-w-lg mx-auto">
      <div class="mb-6">
        <label class="block mb-2">Nombre</label>
        <VField name="DOC_NOMBRE" rules="required|min:3" class="w-full">
          <template #default="{ field, errors }">
            <input type="text" v-bind="field" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
            <span class="text-red-500">{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div class="mb-6">
        <label class="block mb-2">Tipo</label>
        <VField name="DOC_ID_TIPO" rules="required" class="w-full">
          <template #default="{ field, errors }">
            <select v-bind="field" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
              <option value="">Selecciona un tipo</option>
              <option v-for="tipo in tipos" :value="tipo.TIP_ID" :key="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
            </select>
            <span class="text-red-500">{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div class="mb-6">
        <label class="block mb-2">Proceso</label>
        <VField name="DOC_ID_PROCESO" rules="required" class="w-full">
          <template #default="{ field, errors }">
            <select v-bind="field" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
              <option value="">Selecciona un proceso</option>
              <option v-for="proceso in procesos" :value="proceso.PRO_ID" :key="proceso.PRO_ID">{{ proceso.PRO_NOMBRE }}</option>
            </select>
            <span class="text-red-500">{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div class="mb-6">
        <label class="block mb-2">Contenido</label>
        <VField name="DOC_CONTENIDO" rules="required|min:10" class="w-full">
          <template #default="{ field, errors }">
            <textarea v-bind="field" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"></textarea>
            <span class="text-red-500">{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Guardar</button>
    </VForm>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      documento: {
        DOC_NOMBRE: '',
        DOC_ID_TIPO: '',
        DOC_ID_PROCESO: '',
        DOC_CONTENIDO: ''
      },
      tipos: [],
      procesos: []
    };
  },
  created() {
    this.obtenerTipos();
    this.obtenerProcesos();
  },
  methods: {
    obtenerTipos() {
      axios.get('/api/tipos', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(response => {
        this.tipos = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
    obtenerProcesos() {
      axios.get('/api/procesos', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(response => {
        this.procesos = response.data;
      })
      .catch(error => {
        console.error(error);
      });
    },
    guardarDocumento(values) {
      axios.post('/api/documentos', values, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      })
      .then(() => {
        this.$router.push('/');
      })
      .catch(error => {
        console.error(error);
      });
    }
  }
};
</script>
