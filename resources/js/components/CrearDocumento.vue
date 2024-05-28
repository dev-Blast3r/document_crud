<template>
  <div>
    <h1>Crear Documento</h1>
    <VForm @submit="guardarDocumento">
      <div>
        <label>Nombre</label>
        <VField name="DOC_NOMBRE" rules="required|min:3">
          <template #default="{ field, errors }">
            <input type="text" v-bind="field" />
            <span>{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div>
        <label>Tipo</label>
        <VField name="DOC_ID_TIPO" rules="required">
          <template #default="{ field, errors }">
            <select v-bind="field">
              <option value="">Selecciona un tipo</option>
              <option v-for="tipo in tipos" :value="tipo.TIP_ID" :key="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
            </select>
            <span>{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div>
        <label>Proceso</label>
        <VField name="DOC_ID_PROCESO" rules="required">
          <template #default="{ field, errors }">
            <select v-bind="field">
              <option value="">Selecciona un proceso</option>
              <option v-for="proceso in procesos" :value="proceso.PRO_ID" :key="proceso.PRO_ID">{{ proceso.PRO_NOMBRE }}</option>
            </select>
            <span>{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <div>
        <label>Contenido</label>
        <VField name="DOC_CONTENIDO" rules="required|min:10">
          <template #default="{ field, errors }">
            <textarea v-bind="field"></textarea>
            <span>{{ errors[0] }}</span>
          </template>
        </VField>
      </div>
      <button type="submit">Guardar</button>
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
