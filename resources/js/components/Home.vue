<template>
    <div>
        <h1>Documentos</h1>
        <router-link to="/crear">Crear Documento</router-link>
        <button @click="logout">Cerrar sesión</button>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="documento in documentos" :key="documento.DOC_ID">
                    <td>{{ documento.DOC_NOMBRE }}</td>
                    <td>{{ documento.DOC_CODIGO }}</td>
                    <td>{{ documento.DOC_CONTENIDO }}</td>
                    <td>
                        <router-link :to="'/editar/' + documento.DOC_ID">Editar</router-link>
                        <button @click="eliminarDocumento(documento.DOC_ID)">Eliminar</button>
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