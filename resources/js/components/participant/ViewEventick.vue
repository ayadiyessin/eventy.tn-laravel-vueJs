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
                            <router-link to="/ListTicketsPart"> Liste des tickets
                            </router-link>
                            <span>Affiche ticket</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <!-- Product Details Section Begin -->
        <section class="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img class="show_view_img" :src="event.photo_Event" alt="">

                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3>{{ event.nom_Event }}<span>{{ categ.nomcategorieEvent }}</span></h3>

                            <div class="product__details__price">{{ event.prix_Event }} DT</div>
                            <p>{{ event.adresse_Event }}</p>

                            
                            <div class="product__details__widget">
                                <div class="card">
                                    <div class="card-body">
                                        <span>Les code QR</span>
                                        <span class="float-right text-muted">{{ tick.nb_Tick }} ticket</span>
                                    </div>
                                    <div class="border-bottom"></div>
                                    <table class="tab">
                                        <div class="row">
                                            <div class="col-sm-6" v-for="index in tick.nb_Tick" :key="index">
                                                <div v-if="qrCodes[index - 1]">
                                                    <tr>
                                                        <td>Ticket : {{ index }}</td>
                                                        <td><img :src="qrCodes[index - 1]" alt="Code QR généré" /></td>
                                                    </tr>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->
    </div>
</template>

<script setup>
// Import de QRCode depuis 'qrcode-generator'
import QRCode from 'qrcode-generator';
import { onMounted, ref, computed } from 'vue';



import api from '../config/api.js';

import { useRouter, useRoute } from 'vue-router';

const isLoading = ref(true)
const router = useRouter()
const route = useRoute();
const event = ref({});
const categ = ref({});
const tick = ref([]);
let userId = "";
let userCon = "";
let typeUs = ref('');

const fetchtick = async() => {
    const resp = await api.get(`/api/Ticket/${route.params.id}`)
    tick.value = resp.data;
    const respev = await api.get(`/api/Evenement/${tick.value.evenementsID}`);
    event.value = respev.data;
    const respcat = await api.get(`/api/CategorieEvent/${event.value.categorieEventID}`);
    categ.value = respcat.data;
    isLoading.value = false;
    
    for(var i=0;i<=tick.value.nb_Tick;i++)
    {
        generateQRCode(`${event.value.nom_Event} , Ticket : ${i}`);
    }
}

const qrCodes = ref(Array(5).fill(null));

const generateQRCode = (text) => {
  const typeNumber = 10;
  const errorCorrectionLevel = 'M';

  const qr = QRCode(typeNumber, errorCorrectionLevel);
  qr.addData(text);
  qr.make();

  qrCodes.value.splice(text.charAt(text.length - 1) - 1, 1, qr.createDataURL());
};
onMounted(()=>{
    fetchtick();
})
</script>

<style lang="css" scoped>
.load {
    margin-left: 50%;
    margin-right: 50%;
    margin-top: 20%;
    margin-bottom: 20%;
}

.sz {
    font-size: 40px;
}
.tab{
    margin: 15px;
    font-weight: 600;
}
</style>