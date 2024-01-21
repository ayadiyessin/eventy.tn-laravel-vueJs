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
                            <span>Liste des Tickets</span>
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
                                <h3 class="card-title">Liste des tickets</h3>
                            </div>
                        </div>
                    </div>
                    <div v-if="counttick === 0">
                        <span class="maClasse"> Aucune Ticket</span>
                    </div>
                    <div v-else>
                        <DataTable :value="liste" stripedRows paginator showGridlines :rows="5"
                            :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id" :loading="isLoading">
                            <Column field="nom_Event" header="Nom évènement" sortable></Column>
                            <Column field="nomcategorieEvent" header="Categorie" sortable></Column>
                            <Column field="date" header="Date évènement" sortable></Column>
                            <Column field="nbtick" header="Nombre de ticket" sortable></Column>
                            <Column field="id" header="Actions">
                                <template #body="val">
                                    <div class="d-flex">

                                        <router-link class="btn btn-primary rounded-circle"
                                            :to="{ name: 'ListEventick', params: { id: val.data.id } }">
                                            <i class="fa fa-eye"></i>
                                        </router-link>
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
import { ref, onMounted, computed } from "vue"
import api from '../config/api.js';

let userCon = "";
const isLoading = ref(true)

const liste = ref([]);
const lstTick = ref([]);

//const isLoading = ref(false);
const getlstTick = async () => {
    try {
        const res = await api.get(`/api/tickpart/${userCon}`);
        lstTick.value = res.data;

        await Promise.all(lstTick.value.map(async (item) => {
            const resp = await api.get(`/api/Evenement/${item.evenementsID}`);
            const event = resp.data;
            const respc = await api.get(`/api/CategorieEvent/${event.categorieEventID}`)
            const categ = respc.data;
            return {
                'id': item.id, // Vous devez définir l'id ici en fonction des données de result
                'nom_Event': event.nom_Event,
                'nomcategorieEvent': categ.nomcategorieEvent,
                'date': event.date_Event, // Vous devez définir la quantité appropriée ici
                'nbtick': item.nb_Tick // Vous devez définir l'image appropriée ici
            };
        })).then((results) => {
            // Now, results array contains objects with nompart and img in the correct order
            liste.value.push(...results);
        });
        isLoading.value = false
    } catch (error) {
        console.error(error);
    }
}

const counttick = computed(() =>{
    if (Array.isArray(lstTick.value)) {
        // Utilisez reduce pour sommer la colonne nb_Tick
        return lstTick.value.reduce((sum, item) => sum + item.nb_Tick, 0);
    } else {
        return 0;
    }
});
onMounted(() => {
    userCon = localStorage.getItem('idCon');
    getlstTick();
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