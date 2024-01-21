<template>

    <div >
        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="hero__slider owl-carousel">
                <div class="hero__items set-bg" ref="heroItem"
                    data-setbg="https://res.cloudinary.com/dr8g1jmly/image/upload/v1704546157/Blank_7_Grids_Collage_kepwul.png">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                                <div class="hero__text">
                                    <h2>Eventy.tn</h2>
                                    <p class="justify-text">Bienvenue sur "Eventy.tn" ! Explorez les meilleurs
                                        bons plans et événements près de chez vous. Des offres exclusives, des sorties en
                                        famille,
                                        tout est là, à portée de clic.</p>
                                    <router-link class="primary-btn text-decoration-none" to="/ListePubic">Publication<span
                                            class="arrow_right"></span></router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->
        <!-- Latest Blog Section Begin -->
        <div v-if="isLoading">
            <div class="load">
                <i class="fas fa-spinner fa-spin sz"></i>
            </div>
        </div>
        <div v-else>
            <section class="latest spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Nouvelles</span>
                            <h2>Publications</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6" v-for="(art, index) in pub" :key="index">
                        <div class="blog__item" v-if="index<3">
                            <div class="blog__item__pic set-bg">
                                <img class="modf_img" :src="art.photo_pub" alt="">
                            </div>
                            <div class="blog__item__text">
                                <h5 class="titrepub">{{ art.restauration.nom_rest }}</h5>
                                <span><i class="fa fa-map-pin" aria-hidden="true"></i> {{ listuser[index] }}</span>
                                <span><i class="fa fa-cutlery" aria-hidden="true"></i> {{ listcateg[index] }}</span>
                                <span v-if="listNote[index] !== 0">
                                    <i class="fa fa-check-square"></i> Note :{{ listNote[index] }} / 5
                                </span>
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
            </section>
        </div>
        <!-- Latest Blog Section End -->

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from './config/api.js';
const heroItem = ref(null);
const userId=ref(null);
onMounted(() => {
    userId.value = localStorage.getItem('id');
    setupBackgroundImage(heroItem.value);
})
function setupBackgroundImage(element) {
    const bg = element.dataset.setbg;
    element.style.backgroundImage = `url(${bg})`;
}


const listcateg = ref([]);
const listuser = ref([]);
const listNote = ref([]);
const user = ref([])
const categories = ref([])
const isLoading = ref(true)


const pub = ref([])
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
        .then((res) => { user.value = res.data; })
        .catch((err) => { console.error(err) })
    return user.value.ville_user;
}
const getnote = async (id) => {
    console.log(id)
    await api.get(`/api/moyenNote/${id}`)
        .then((res) => { console.log(res); note.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
    return note.value;
}
const getpublcateg = async (id) => {
    await api.get(`/api/CategorieRest/${id}`)
        .then((res) => { categories.value = res.data; })
        .catch((err) => { console.error(err) })
    return categories.value.nomcategorie;
}



onMounted(() => {

    fetchpub();
})
</script>

<style scoped>
.modf_img {
    width: 360px;
    height: 270px;
}

.justify-text {
    text-align: justify;
}

.hero__text {
    background-color: #e1e1e1;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    /* Ajoutez le rembourrage souhaité */
    margin: 10px;
    /* Ajoutez la marge souhaitée */
}


.load {
    margin-left: 50%;
    margin-right: 50%;
    margin-top: 20%;
    margin-bottom: 20%;
}

.sz {
    font-size: 40px;
}

.titrepub {
    margin-top: 5%;
    font-size: 25px;
}</style>
