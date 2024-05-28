<template>
    <div>
        <h1>Editar Documento</h1>
        <form @submit.prevent="actualizarDocumento">
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
            <button type="submit">Actualizar</button>
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
