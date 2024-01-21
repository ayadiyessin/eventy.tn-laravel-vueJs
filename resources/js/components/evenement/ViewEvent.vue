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
                            <router-link to="/listeEvent"> Liste des évènements
                            </router-link>
                            <span>Plus de détaille</span>
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
                        <img class="show_det_img" :src="event.photo_Event" alt="">

                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3>{{ event.nom_Event }}<span>{{ categ.nomcategorieEvent }}</span></h3>

                            <div class="product__details__price">{{ event.prix_Event }} DT</div>
                            <p>{{ event.adresse_Event }}</p>

                            <div class="rest">Reste : <span>{{ event.nbPlace_Event - counttick }} Tickets</span></div>

                            <div class="product__details__button" v-if="typeUs === 'participant'">
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="cart-product-quantity">
                                        <button @click="minus()" v-if="nbtick > 1">-</button>
                                        <div class="count">
                                            <strong> {{ nbtick }} </strong>
                                        </div>
                                        <button @click="plus(event.nbPlace_Event - counttick)">+</button>
                                    </div>
                                </div>
                                

                                
                                    <button class="cart-btn text-decoration-none" @click="addToCart(event,nbtick)">Acheter</button>
                                    <!--<Payment :ticket="ticket"/> -->

                            </div>
                            <div class="product__details__widget">
                                <div class="card">
                                    <div class="card-body">
                                        <span>Les Commantaires</span>
                                        <span class="float-right text-muted">{{ commentCount }} comments</span>
                                    </div>
                                    <div v-if="commentCount === 0">
                                        <span class="maClasse"> Aucune Commantaire</span>
                                    </div>
                                    <div class="card-footer card-comments" v-else>

                                        <div class="card-comment" v-for="(value, key) in com" :key="value.id">
                                            <!-- User image -->
                                            <img class="img-circle img-sm" :src="listuser[key]" alt="User Image">

                                            <div class="comment-text">
                                                <span class="username">
                                                    {{ listpart[key] }}
                                                    <span class="text-muted float-right">{{
                                                        getdatecom(value.created_at) }}</span>
                                                </span>
                                                {{ value.commentaire_Event }}
                                            </div>
                                            <!-- /.comment-text -->
                                        </div>
                                        <!-- /.card-comment -->
                                    </div>
                                    <!-- /.card-footer -->
                                    <div class="card-footer" v-if="typeUs === 'participant'">
                                        <form @submit.prevent="addcom">
                                            <img class="img-circle img-sm" :src="usimg.image_user" alt="Alt Text">
                                            <!-- .img-push is used to add margin to elements next to floating images -->
                                            <div class="img-push">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Press enter to post comment"
                                                        v-model="coment.commentaire_Event">
                                                    <span class="input-group-append">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fa-solid fa-play"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-footer -->
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

import { ref, onMounted, computed } from "vue"
import api from '../config/api.js';
import store from '../../store'
import { useRouter, useRoute } from 'vue-router';
const isLoading = ref(true)
const nbtick = ref(null);
const router = useRouter()
const route = useRoute();
const event = ref({});
const categ = ref({});
const com = ref([]);
let userId = "";
let userCon = "";
let typeUs = ref('');

const fetchevent = async () => {
    await api.get(`/api/Evenement/${route.params.id}`)
        .then((res) => {
            event.value = res.data; console.log(route.params.id);
            fetchcateg(event.value.categorieEventID);
        })
        .catch((err) => { console.error(err) })
}


const fetchcateg = async (idcat) => {
    await api.get(`/api/CategorieEvent/${idcat}`)
        .then((res) => { categ.value = res.data; })
        .catch((err) => { console.error(err) })
}
const listpart = ref([]);
const listuser = ref([]);
const fetchcom = async () => {

    try {
        const res = await api.get(`/api/listeComParEven/${route.params.id}`);
        com.value = res.data;

        // Utiliser Promise.all pour attendre la résolution de toutes les promesses
        await Promise.all(com.value.map(async (item) => {
            const nompart = await getNompart(item.participantsID);
            const img = await getimg(item.participantsID);

            return { nompart, img };
        })).then((results) => {
            // Now, results array contains objects with nompart and img in the correct order
            listpart.value.push(...results.map(result => result.nompart));
            listuser.value.push(...results.map(result => result.img));
        });
        console.log(listpart.value)
        console.log(listuser.value)
        console.log(com.value)
        isLoading.value = false
    } catch (error) {
        console.error(error);
    }
}

const part = ref([]);
const getNompart = async (idpart) => {
    await api.get(`/api/Participants/${idpart}`)
        .then((res) => { part.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
    return part.value.nom_part + " " + part.value.prenom_part;
}

const user = ref([]);
const getimg = async (idpart) => {
    await api.get(`/api/Participants/${idpart}`)
        .then((res) => { part.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
    await api.get(`/api/users/${part.value.usersID}`)
        .then((res) => { user.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
    return user.value.image_user;
}

const usimg = ref([])
const getimguser = async () => {
    await api.get(`/api/users/${userId}`)
        .then((res) => { usimg.value = res.data; console.log(res.data) })
        .catch((err) => { console.error(err) })
}


const getdatecom = (datcom) => {
    const sp = datcom.split('.');
    const sp1 = sp[0].split('T');
    return sp1[0] + " " + sp1[1];
}
const tick = ref([])
const getticket = async () => {
    await api.get(`/api/Tickevent/${route.params.id}`)
        .then((res) => {
            tick.value = res.data;
        })
        .catch((err) => { console.error(err) })
}
const counttick = computed(() =>{
    if (Array.isArray(tick.value)) {
        // Utilisez reduce pour sommer la colonne nb_Tick
        return tick.value.reduce((sum, item) => sum + item.nb_Tick, 0);
    } else {
        return 0;
    }
});

const commentCount = computed(() => com.value.length);
const coment = ref({
    commentaire_Event: ""
})
const addcom = async () => {
    await api.post(`/api/AjoutComEven/${userCon}/${route.params.id}/`, coment.value)
        .then(res => {
            window.location.reload();
        })
        .catch((err) => { console.error(err) })
}

//qantiter
const prod = ref([])
const plus = (item) => {
    
    if (nbtick.value < item) {
        nbtick.value = nbtick.value + 1;
    }
    else
        alert("Quantité stock indisponible")

}
const minus = () => {
    if (nbtick.value < 1) {
        alert("Quantité stock non valable")
    }
    else
        nbtick.value = nbtick.value-1;
}

onMounted(() => {
    userId = localStorage.getItem('id');
    userCon = localStorage.getItem('idCon');
    //typeUs = String(localStorage.getItem('type'));
    typeUs.value = localStorage.getItem('type') || '';
    nbtick.value = 1;
    localStorage.setItem('visible', false);
    fetchevent();
    fetchcom();
    getimguser();
    getticket();
});

const ticket = ref({
    nb_Tick : "",
    evenementsID : route.params.id,
    participantsID : localStorage.getItem('idCon')
})

const addToCart=(prod,ttikk)=> {
    ticket.value.nb_Tick = nbtick.value;
    console.log(ticket.value)
    store.commit('Ticketstore/clearCart');
    store.commit("Ticketstore/addCart", { payload: { product: ticket.value } });
    router.push(`/payment/${route.params.id}`)
}
const enregisterTick = async() => {
    ticket.value.nb_Tick = nbtick.value;
    //ticket.value.visible = true;
    //ticket.value.prix = event.value.prix_Event;
    console.log(ticket.value)
    await api.post('/api/Ticket/', ticket.value)
        .then((res) => {
            //router.push("/ListTicketsPart")
            console.log(res);
        })
        .catch(error => {
            console.error("There was an error!", error);
        })
        Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'Achate avec succès',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.replace("/ListTicketsPart");
                }
            })
}


</script>

<style scoped>
.cart-product-quantity button {
    border: none;
    outline: none;
    background: none;
    cursor: pointer;
    width: 12px;
    line-height: 46px;
    font-size: 14px;
    color: #666666;
}

.cart-product-quantity {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    height: 50px;
    width: 150px;
    border: 1px solid #ebebeb;
    border-radius: 50px;
    padding: 0 20px;
}

.cart-product-quantity strong {
    font-size: 14px;
    color: #666666;
    font-weight: 500;
    border: none;
    float: left;
    width: 84px;
    text-align: center;
    height: 48px;
}
.count {
    padding: 0.7rem 0;
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

.rest {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 30px;
}

.rest span {
    font-size: 16px;
    font-weight: 100;
    margin-left: 10px;
    display: inline-block;
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