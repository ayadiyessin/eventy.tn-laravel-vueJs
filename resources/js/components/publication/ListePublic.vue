<template>
    <div>
        <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <router-link to="/">
                                <i class="fa fa-home"></i> Accueil
                            </router-link>
                            <span>Liste des Publication</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Nouvelles</span>
                        <h2>Liste des Publication</h2>
                    </div>
                </div>
            </div>
            <div v-if="isLoading">
                <div class="load">
                    <i class="fas fa-spinner fa-spin sz"></i>
                </div>
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6" v-for="(art, index) in pub" :key="index">
                        <div class="blog__item" >
                            <div class="blog__item__pic set-bg">
                                <img class="modf_img" :src="art.photo_pub" alt="">
                            </div>
                            <div class="blog__item__text">
                                <h5 class="titrepub">{{ art.restauration.nom_rest }}</h5>
                                <span><i class="fa fa-map-pin" aria-hidden="true"></i> {{ listuser[index] }}</span>
                                <span><i class="fa fa-cutlery" aria-hidden="true"></i> {{ listcateg[index] }}</span>
                                <span v-if="listNote[index] !== 0"><i class="fa fa-check-square"></i> Note :
                                    {{ listNote[index] }} / 5</span>
                                <div v-if="userId !==null">
                                    <router-link class="text-decoration-none" :to="{ name: 'DetaillePublic', params: { id: art.id } }">Plus Détaille</router-link>
                                </div>
                                <div v-else>
                                    <router-link class="text-decoration-none" to="/loginPart">Plus Détaille</router-link>
                                </div>

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
//const publication=ref([])
const listcateg = ref([]);
const listuser = ref([]);
const listNote = ref([]);
const user = ref([])
const categories = ref([])
const isLoading = ref(true)
//const isLoading = ref(false);
// const getpublication=async()=>{
//     //isLoading.value = true;
//     await api.get("/api/Publication")
//     .then(res=>{
//         publication.value=res.data;
//         isLoading.value = false
//     })
//     .catch(error=>{
//         console.log(error)
//     })
// }

const pub=ref([])
const note = ref([])
const fetchpub = async () => {
    try {
        const res = await api.get("/api/Publication");
        pub.value = res.data;

        // Utiliser Promise.all pour attendre la résolution de toutes les promesses
        const results = await Promise.all(pub.value.map(async (item) => {
            const ville = await getpubluser(item.restauration.usersID);
            const nomCat = await getpublcateg(item.restauration.categorieRestID);
            const note = await getnote(item.id);

            return { ville, nomCat, note, pub: item };
        }));

        // Trier la liste de manière décroissante en fonction de la note
        results.sort((a, b) => b.note - a.note);

        // Mettre à jour les différentes listes
        listNote.value = results.map(result => result.note);
        listcateg.value = results.map(result => result.nomCat);
        listuser.value = results.map(result => result.ville);
        pub.value = results.map(result => result.pub);

        console.log(listNote.value);
        console.log(listcateg.value);
        console.log(listuser.value);
        console.log(pub.value);
        isLoading.value = false;

    } catch (error) {
        console.error(error);
    }
};
const getpubluser = async (id) => {
    await api.get(`/api/users/${id}`)
        .then((res) => { user.value = res.data;  })
        .catch((err) => { console.error(err) })
    return user.value.ville_user;
}
const getnote = async (id) => {
    console.log(id)
    await api.get(`/api/moyenNote/${id}`)
        .then((res) => {console.log(res); note.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
    return note.value;
}
const getpublcateg = async (id) => {
    await api.get(`/api/CategorieRest/${id}`)
        .then((res) => { categories.value = res.data;  })
        .catch((err) => { console.error(err) })
    return categories.value.nomcategorie;
}
const userId=ref(null);
onMounted(()=>{
    userId.value = localStorage.getItem('id');
    //getpublication();
    fetchpub();
    //getpubluser();
    //getpublcateg();
})
</script>

<style scoped>
    .modf_img{
        width: 360px;
        height: 270px;
    }
    .load{
    margin-left: 50%;
    margin-right: 50%;
    margin-top: 20%;
    margin-bottom: 20%;
}
.sz{
    font-size: 40px;
}
.titrepub{
    margin-top: 5%;
    font-size: 25px;
}
</style>
