<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Documentos</h1>
    <router-link to="/crear" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-black rounded shadow-md hover:bg-blue-600">Crear Documento</router-link>
    <button @click="logout" class="mb-4 px-4 py-2 bg-red-500 text-black rounded shadow-md hover:bg-red-600">Cerrar sesión</button>
    <table class="w-full border-collapse">
      <thead>
        <tr>
          <th class="px-4 py-2 bg-gray-200 text-left">Nombre</th>
          <th class="px-4 py-2 bg-gray-200 text-left">Código</th>
          <th class="px-4 py-2 bg-gray-200 text-left">Contenido</th>
          <th class="px-4 py-2 bg-gray-200 text-left">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="documento in documentos" :key="documento.DOC_ID" class="border-t">
          <td class="px-4 py-2">{{ documento.DOC_NOMBRE }}</td>
          <td class="px-4 py-2">{{ documento.DOC_CODIGO }}</td>
          <td class="px-4 py-2">{{ documento.DOC_CONTENIDO }}</td>
          <td class="px-4 py-2">
            <router-link :to="'/editar/' + documento.DOC_ID" class="text-blue-500 hover:underline mr-2">Editar</router-link>
            <button @click="eliminarDocumento(documento.DOC_ID)" class="text-red-500 hover:underline">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            documentos: [],
        };
    },
    methods: {
        fetchDocumentos() {
            const token = localStorage.getItem('token');
            axios.get('/api/documentos', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                this.documentos = response.data;
                console.log('resp', response.data)
            });
        },
        eliminarDocumento(id) {
            axios.delete(`/api/documentos/${id}`, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response => {
                this.fetchDocumentos();
            });
        },
        logout() {
            axios.post('/api/logout', null, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
                .then(response => {
                    // Eliminar el token de autenticación del almacenamiento local
                    localStorage.removeItem('token');

                    // Redireccionar al usuario a la página de inicio
                    this.$router.push('/login');
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    created() {
        this.fetchDocumentos();
    },
};
</script>