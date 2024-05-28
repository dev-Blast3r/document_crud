<template>
  <div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Editar Documento</h1>
    <form @submit.prevent="actualizarDocumento" class="max-w-lg mx-auto">
      <div class="mb-6">
        <label class="block mb-2">Nombre</label>
        <input type="text" v-model="documento.DOC_NOMBRE" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500" />
      </div>
      <div class="mb-6">
        <label class="block mb-2">Tipo</label>
        <select v-model="documento.DOC_ID_TIPO" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
          <option v-for="tipo in tipos" :value="tipo.TIP_ID" :key="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
        </select>
      </div>
      <div class="mb-6">
        <label class="block mb-2">Proceso</label>
        <select v-model="documento.DOC_ID_PROCESO" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500">
          <option v-for="proceso in procesos" :value="proceso.PRO_ID" :key="proceso.PRO_ID">{{ proceso.PRO_NOMBRE }}</option>
        </select>
      </div>
      <div class="mb-6">
        <label class="block mb-2">Contenido</label>
        <textarea v-model="documento.DOC_CONTENIDO" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"></textarea>
      </div>
      <button type="submit" class="bg-blue-500 text-black py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">Actualizar</button>
    </form>
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
        this.obtenerDocumento();
        this.obtenerTipos();
        this.obtenerProcesos();
    },
    methods: {
        obtenerDocumento() {
            axios.get(`/api/documentos/${this.$route.params.id}`, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.documento = response.data;
            })
            .catch(error => {
                console.error(error);
            });
        },
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
        actualizarDocumento() {
            axios.put(`/api/documentos/${this.$route.params.id}`, this.documento,{
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
