<template>
    <div >
        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <router-link to="/">
                                <i class="fa fa-home"></i> Accueil
                            </router-link>
                            <router-link to="/listeEvent"> Liste des évènements</router-link>
                            <span>Acheter tickets</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <section class="product-details form_prof">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <form @submit.prevent="handleSubmit">
                            

                            <div class="card" style="width: 50rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Acheter Ticket</h5>
                                    <div class="border-bottom"></div>
                                    <div class="card-text">
                                        <div class="rest">Nombre de Tickets que Vous-Avez acheter : <span>{{ store.state.Ticketstore.event[0].nb_Tick }} Ticket(s)</span></div>
                                        <div class="rest">Montant à payer : <span>{{ amount }} TND</span></div>
                                        <div class="rest">Email : <span>{{user.email }}</span></div>
                                        <div v-if="ticketPut !==null">
                                            <div class="rest">Vous-Avez acheter déja  : <span>{{ticketPut.nb_Tick }} Tickets</span></div>
                                        </div>
                                    </div>
                                    <div class="rest">Paiement :</div>
                                    <div id="card-element">
                                    </div>
                                    <button type="submit" class="mt-4 btn-pers">Payée</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { loadStripe } from '@stripe/stripe-js';
import store from '../../store'
import api from "../config/api.js";
import { useRouter,  useRoute  } from 'vue-router';
const isLoading = ref(true)
const router = useRouter();
const route = useRoute();
const event = ref([])
let userCon =""
const stripePromise =
    loadStripe('pk_test_51OMBZ0BVsyuRHtfMLfpbY2XJQCCZTMEP5dDrpbuPtSmra5VOrKVoUr6eJo3NSK2Y1D0nNOCzGKaeMHLsBYJMBi5w00MOzlVGPa');
const stripe = ref(null);
let cardElement; // Déclarer cardElement comme variable globale
let amount = ref(0);
let email = ref("");
let userid = "";
const user = ref([])
const getuser=async(idu)=>{
    await api.get(`/api/users/${idu}`)
    .then(res=>{
        user.value=res.data
        console.log(user);
    })
    .catch(error=>{
        console.log(error)
    })
}
const fetchevent = async () => {
    await api.get(`/api/Evenement/${route.params.id}`)
        .then((res) => {
            event.value = res.data;
            amount.value = store.state.Ticketstore.event[0].nb_Tick * event.value.prix_Event;

        })
        .catch((err) => { console.error(err) })
}
const ticketPut = ref(null)
const fetchTick = async(idp) => {
    const resp = await api.get(`api/tickpartevent/${idp}/${route.params.id}`);
    console.log(resp.data);
    if(resp.data !=0)
    {
        ticketPut.value = resp.data[0];
    }

}

onMounted(async () => {
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();
    cardElement = elements.create('card'); // Affecter cardElement
    cardElement.mount('#card-element');
    userid = localStorage.getItem('id');
    userCon = localStorage.getItem('idCon')
    fetchevent();
    fetchTick(userCon);
    getuser(userid);
    console.log(store.state.Ticketstore.event)
    
});

const ticket = ref({
    nb_Tick : store.state.Ticketstore.event[0].nb_Tick,
    evenementsID : route.params.id,
    participantsID : localStorage.getItem('idCon')
})

const handleSubmit = async () => {
    const { token, error } = await stripe.value.createToken(cardElement);
    if (error) {
        console.error(error);
    } else {
        // Envoie le token au serveur pour traiter le paiement
        const response = await api.post('/api/createpayment', {
            token: token.id,
            amount: amount.value * 100, // Convertir le montant en cents
            email: user.value.email
        });
        if (response.data.message) {

            if(ticketPut.value != null)
            {
                ticketPut.value.nb_Tick += store.state.Ticketstore.event[0].nb_Tick
                await api.put(`/api/Ticket/${ticketPut.value.id}`, ticketPut.value)
                .then((res) => {
                    console.log(res);
                })
                .catch(error => {
                    console.error("There was an error!", error);
                })
            }
            else
            {
                await api.post('/api/Ticket/', ticket.value)
                .then((res) => {
                    console.log(res);
                })
                .catch(error => {
                    console.error("There was an error!", error);
                })
            }
            store.commit('Ticketstore/clearCart')
                Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Achate avec succès',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.replace("/ListTicketsPart");
                        }
                    })
        } else {
            console.error(response.data.error);
        }
    }
};
</script>
<style>
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
</style>