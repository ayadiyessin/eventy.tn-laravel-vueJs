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
        <!-- Latest Blog Section Begin -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Nouvelles</span>
                        <h2>Evènements</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6" v-for="art in event" :key="art.id">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg">
                            <img class="modf_img" :src="art.photo_Event" alt="">
                        </div>
                        <div class="blog__item__text">
                            
                            <span><img src="../img/icon/calendar.png" alt=""> {{ art.date_Event }}</span>
                            <h5>{{ art.nom_Event.substr(0, 20) }}</h5>
                            <div v-if="userId !==null">
                                <router-link class="text-decoration-none" :to="{name: 'DetailleEvent', params: { id: art.id }}">Plus Détaille</router-link>
                            </div>
                            <div v-else>
                                <router-link class="text-decoration-none" to="/loginPart">Plus Détaille</router-link>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Latest Blog Section End -->
    </div>
</template>

<script setup>
import { ref,onMounted } from "vue"
import api from '../config/api.js';
const event=ref([])
const isLoading = ref(true)
//const isLoading = ref(false);
const getevenment=async()=>{
    //isLoading.value = true;
    await api.get("/api/Evenement")
    .then(res=>{
        event.value=res.data;
    })
    .catch(error=>{
        console.log(error)
    })
    isLoading.value = false
}


const userId=ref(null);
onMounted(()=>{
    userId.value = localStorage.getItem('id');
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
    .modf_img{
        width: 360px;
        height: 270px;
    }
</style>