<template>
    <div>
        <h1>Gestión de Documentos</h1>
        <button @click="crearDocumento">Crear Documento</button>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="documento in documentos" :key="documento.DOC_ID">
                    <td>{{ documento.DOC_NOMBRE }}</td>
                    <td>{{ documento.DOC_CODIGO }}</td>
                    <td>
                        <button @click="editarDocumento(documento.DOC_ID)">Editar</button>
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
            documentos: []
        };
    },
    created() {
        this.obtenerDocumentos();
    },
    methods: {
        obtenerDocumentos() {
            axios.get('/api/documentos')
                .then(response => {
                    this.documentos = response.data;
                    console.log('respi', responde.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        crearDocumento() {
            this.$router.push('/documentos/crear');
        },
        editarDocumento(id) {
            this.$router.push(`/documentos/${id}/editar`);
        },
        eliminarDocumento(id) {
            if (confirm('¿Estás seguro de eliminar este documento?')) {
                axios.delete(`/api/documentos/${id}`)
                    .then(() => {
                        this.obtenerDocumentos();
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }
};
</script>
