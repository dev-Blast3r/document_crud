<template>
    <div>
        <h1>Crear Documento</h1>
        <form @submit.prevent="guardarDocumento">
            <div>
                <label>Nombre</label>
                <input type="text" v-model="documento.DOC_NOMBRE">
            </div>
            <div>
                <label>Tipo</label>
                <select v-model="documento.DOC_ID_TIPO">
                    <option v-for="tipo in tipos" :value="tipo.TIP_ID" :key="tipo.TIP_ID">{{ tipo.TIP_NOMBRE }}</option>
                </select>
            </div>
            <div>
                <label>Proceso</label>
                <select v-model="documento.DOC_ID_PROCESO">
                    <option v-for="proceso in procesos" :value="proceso.PRO_ID" :key="proceso.PRO_ID">{{
                        proceso.PRO_NOMBRE }}</option>
                </select>
            </div>
            <div>
                <label>Contenido</label>
                <textarea v-model="documento.DOC_CONTENIDO"></textarea>
            </div>
            <button type="submit">Guardar</button>
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
        this.obtenerTipos();
        this.obtenerProcesos();
    },
    methods: {
        obtenerTipos() {
            axios.get('/api/tipos', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token') // Aquí se incluye el token de autenticación
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
                    Authorization: 'Bearer ' + localStorage.getItem('token') // Aquí se incluye el token de autenticación
                }
            })
                .then(response => {
                    this.procesos = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        guardarDocumento() {
            axios.post('/api/documentos', this.documento, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token') // Aquí se incluye el token de autenticación
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
