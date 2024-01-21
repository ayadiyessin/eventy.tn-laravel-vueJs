<template>
    <div>
        <!-- Header Section Begin -->
        <header class="header">
            <div class="rowM">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="header__logo">
                        <a><img class="mof_log" src="../components/img/noir4.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active">

                                <router-link class="nav-link" to="/">Accueil</router-link>
                            </li>
                            <li>

                                <router-link class="nav-link" to="/listeEvent">Evènement</router-link>
                            </li>
                            <li>

                                <router-link class="nav-link" to="/ListePubic">Publication</router-link>
                            </li>
                            <li>
                                <router-link class="nav-link" to="/aboutus">A Propos</router-link>
                            </li>

                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="header__right" v-if="userId">
                        <ul v-if="typeUs ==='organisateur' ">
                            <li class="header__right__auth">
                                <div class="nom_us">
                                    <a><img class="mod_us" src="./img/utilisateur.png" alt="" /><span class="spn_hed">{{ org.nom_org}}</span></a>
                                </div>
                                <ul class="dropdown">
                                    <img class="img_hed" :src="user.image_user">

                                    <span class="span_hed">{{org.nom_org}}</span>
                                    <li>
                                        <router-link class="nav-link" to="/profilOrg">Profile</router-link>
                                    </li>
                                    <li>
                                        <router-link class="nav-link" to="/listEventOrg">Liste Evenement</router-link>
                                    </li>
                                    <li><a @click="logout">Déconnexion</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul v-if="typeUs ==='restauration' ">
                            <li class="header__right__auth">
                                <div class="nom_us">
                                    <a><img class="mod_us" src="./img/utilisateur.png" alt="" /><span class="spn_hed">{{ rest.nom_rest}}</span></a>
                                </div>
                                <ul class="dropdown">
                                        <img class="img_hed" :src="user.image_user">

                                        <span class="span_hed">{{ rest.nom_rest}}</span>
                                    <li>
                                        <router-link class="nav-link" to="/ProfilRest">Profile</router-link>
                                    </li>
                                    <li>
                                        <router-link class="nav-link" to="/ListePubicRest">Liste Publication</router-link>
                                    </li>
                                    <li><a @click="logout">Déconnexion</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul v-if="typeUs ==='participant' ">
                                <li class="header__right__auth">
                                    <div class="nom_us">
                                        <a><img class="mod_us" src="./img/utilisateur.png" alt="" />{{ part.nom_part+" "+ part.prenom_part }}</a>
                                    </div>
                                    <ul class="dropdown">
                                            <img class="img_hed" :src="user.image_user">

                                            <span class="span_hed">{{ part.nom_part+" "+ part.prenom_part }}</span>
                                        <li>
                                            <router-link class="nav-link" to="/ProfilParticipant">Profile</router-link>
                                        </li>
                                        <li>
                                            <router-link class="nav-link" to="/ListTicketsPart">Liste Tickets</router-link>
                                        </li>
                                        <li><a @click="logout">Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                    </div>
                    <div class="header__right" v-else>
                        <ul>
                            <li class="header__right__auth">
                                <div class="nom_us">
                                    <a>Connexion</a>
                                </div>
                                <ul class="dropdown">
                                    <li>
                                        <router-link class="nav-link" to="/loginOrg">Organisateur</router-link>
                                    </li>
                                    <li>
                                        <router-link class="nav-link" to="/loginPart">Participant</router-link>
                                    </li>
                                    <li>
                                        <router-link class="nav-link" to="/loginRest">Restauration</router-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                    <!--Restouration -->
                    <!-- <div class="header__right">
                            <ul>
                                <li class="header__right__auth">
                                    <div class="nom_us">
                                        <a><img class="mod_us" src="./img/utilisateur.png" alt="" /> Nom User</a>
                                    </div>
                                    <ul class="dropdown">
                                            <img class="img_hed" src="https://res.cloudinary.com/dz5lj5hke/image/upload/v1697463766/samples/man-portrait.jpg">

                                            <span class="span_hed">Nom User</span>
                                        <li>
                                            <router-link class="nav-link" to="/ProfilRest">Profile</router-link>
                                        </li>
                                        <li>
                                            <router-link class="nav-link" to="/ListePubicRest">Liste Publication</router-link>
                                        </li>
                                        <li><a class="text-decoration-none" href="./checkout.html">Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> -->
                    <!--participant-->
                    <!-- <div class="header__right">
                            <ul>
                                <li class="header__right__auth">
                                    <div class="nom_us">
                                        <a><img class="mod_us" src="./img/utilisateur.png" alt="" /> Nom User</a>
                                    </div>
                                    <ul class="dropdown">
                                            <img class="img_hed" src="https://res.cloudinary.com/dz5lj5hke/image/upload/v1697463766/samples/man-portrait.jpg">

                                            <span class="span_hed">Nom User</span>
                                        <li>
                                            <router-link class="nav-link" to="/ProfilParticipant">Profile</router-link>
                                        </li>
                                        <li>
                                            <router-link class="nav-link" to="/ListTicketsPart">Liste Tickets</router-link>
                                        </li>
                                        <li><a class="text-decoration-none" href="./checkout.html">Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> -->
                </div>
            </div>
        </header>
        <!-- Header Section End -->
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from './config/api.js';
import { useRouter } from 'vue-router';

localStorage.setItem('isLoadingMenu',true)
const router = useRouter();
const logout = async () => {
    let token = ""
    token = localStorage.getItem('token')
    console.log(token)
    api.post('/api/logout', null, {
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
        .then((response) => {
            console.log(response)
            localStorage.removeItem('token')
            localStorage.removeItem('id')
            window.location.href="/";
        })
        .catch(err => { console.log(err); alert(err) })
}

const userId = ref(null);
const typeUs = ref(null);
const user=ref([]);
const org=ref([]);
const part=ref([]);
const rest=ref([]);
const getuser=async()=>{
    await api.get(`/api/users/${userId.value}`)
    .then(res=>{
        user.value=res.data
        console.log(user);
    })
    .catch(error=>{
        console.log(error)
    })
}

const getorg=async()=>{
    await api.get(`/api/Org/${userId.value}`)
    .then(res=>{
        org.value=res.data[0];
        console.log(org);
    })
    .catch(error=>{
        console.log(error)
    })
}

const getpart=async()=>{
    await api.get(`/api/Partic/${userId.value}`)
    .then(res=>{
        part.value=res.data[0];
    })
    .catch(error=>{
        console.log(error)
    })
}

const getrest=async()=>{
    await api.get(`/api/Rest/${userId.value}`)
    .then(res=>{
        rest.value=res.data[0];
    })
    .catch(error=>{
        console.log(error)
    })
}
onMounted(() => {
  userId.value = localStorage.getItem('id');
  typeUs.value = String(localStorage.getItem('type'));
  if(userId.value)
  {
    getuser();
    if(typeUs.value == 'organisateur')
    {
        getorg();
    }else if(typeUs.value == 'participant')
            {
                getpart();
            }
            else
            {
                getrest();
            }

  }
});
</script>

<style scoped>
.mod_us {
    width: 18px;
    height: 16px;
}

.mof_log {
    width: 230px;
    height: 30px;
    padding-left: 60px;
}
.spn_hed{
    padding-left: 10px;
}
.rowM {
  --bs-gutter-y: 0;
  display: flex;
  flex-wrap: wrap;
  margin-top: calc(-1 * var(--bs-gutter-y));
  margin-left: calc(-0.5 * var(--bs-gutter-x));
}
</style>
