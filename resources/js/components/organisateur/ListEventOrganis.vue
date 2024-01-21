<template>
    <div v-if="isLoading">
        <div class="load">
            <i class="fas fa-spinner fa-spin sz"></i>
        </div>
    </div>
    <div v-else>
        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <router-link to="/">
                                <i class="fa fa-home"></i> Accueil
                            </router-link>
                            <span>Liste des évènements</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8 form_prof">
                <div class="card">
                    <div class="card-header border-transparent">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="card-title">Liste des évenements</h3>
                            </div>
                            <div class="col-sm-6">
                                <router-link class="btn btn-outline-primary float-right" to="/addEvent">Ajouter <i
                                        class="fa fa-plus-circle"></i></router-link>
                            </div>
                        </div>
                    </div>
                    <div v-if="commentCount === 0">
                        <span class="maClasse"> Aucune évènement</span>
                    </div>
                    <div v-else>
                        <DataTable :value="event" stripedRows paginator showGridlines :rows="5"
                            :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id" :loading="isLoading">
                            <Column field="nom_Event" header="Nom" sortable></Column>
                            <Column field="date_Event" header="Date évènement" sortable></Column>
                            <Column field="prix_Event" header="Prix" sortable></Column>
                            <Column field="nbPlace_Event" header="Nombre de place" sortable></Column>
                            <Column field="id" header="Actions">
                                <template #body="val">
                                    <div class="d-flex">
                                        <EditEvent :art="val.data" />
                                    </div>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import EditEvent from '../evenement/EditEvent.vue';
import { ref, onMounted, computed } from "vue"
import api from '../config/api.js';
const event = ref([])
let userCon ="";
const isLoading = ref(true)
const getevenment = async () => {
    
    api.get(`/api/EventOrg/${userCon}`)
        .then(res => {
            event.value = res.data;
            isLoading.value = false;
        })
        .catch(error => {
            console.log(error)
        })
    
}

const commentCount = computed(() => event.value.length);

onMounted(() => {
    userCon = localStorage.getItem('idCon');
    getevenment();
})

</script>

<style scoped>
.load {
    margin-left: 50%;
    margin-right: 50%;
    margin-top: 20%;
    margin-bottom: 20%;
}

.sz {
    font-size: 40px;
}
.maClasse {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #0e0e0ea3;
    /* Couleur du texte */
    margin: 10px;
    /* Marge de 10 pixels de tous les côtés */
    padding: 10px;
    /* Ajoute un espace à l'intérieur de la balise */
}
</style>