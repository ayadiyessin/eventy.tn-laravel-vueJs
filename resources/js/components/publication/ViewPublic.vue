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
                            <router-link to="/ListePubic"> Liste des Publications
                            </router-link>
                            <span>Plus de détaille</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
        <section class="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <img class="show_det_img" :src="pub.photo_pub" alt="">

                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3>{{ restau.nom_rest }} </h3>

                            <div class="spanAvis" v-if="Countnote > 0">
                                <span>{{ note }} <i class="fa fa-star"></i></span>
                                <span>( {{ Countnote }} avis )</span>
                            </div>
                            <span><img class="img_loc" src="../img/map.png" alt=""> {{ users.ville_user }} , {{users.adresse_user }}</span>
                            <p>{{ pub.dersc_pub }}</p>
                            <div v-if="counttpub === 0">
                                <div class="border-bottom" v-if="typeUs === 'participant'"></div>
                                <div v-if="typeUs === 'participant'">
                                    <div class="modSpan">
                                        <span > Donner votre avis </span>
                                    
                                    
                                    <div class="rate">
                                        <input type="radio" id="star5" name="rate" value="5" @click="test_check();" />
                                        <label for="star5" title="text">5 stars</label>
                                        <input type="radio" id="star4" name="rate" value="4" @click="test_check();" />
                                        <label for="star4" title="text">4 stars</label>
                                        <input type="radio" id="star3" name="rate" value="3" @click="test_check();" />
                                        <label for="star3" title="text">3 stars</label>
                                        <input type="radio" id="star2" name="rate" value="2" @click="test_check();" />
                                        <label for="star2" title="text">2 stars</label>
                                        <input type="radio" id="star1" name="rate" value="1" @click="test_check();" />
                                        <label for="star1" title="text">1 star</label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="border-bottom" v-if="typeUs === 'participant'"></div>
                                <div v-if="typeUs === 'participant'">
                                    <div class="modSpan">
                                        <span > Modifier votre avis </span>
                                    
                                    
                                        <div class="rate">
                                            <input type="radio" id="star55" class="star-input" name="rate" value="5" @click="put_check();" />
                                            <label for="star55" title="text" class="star-label">5 stars</label>
                                            <input type="radio" id="star44" class="star-input" name="rate" value="4" @click="put_check();" />
                                            <label for="star44" title="text" class="star-label">4 stars</label>
                                            <input type="radio" id="star33" class="star-input" name="rate" value="3" @click="put_check();" />
                                            <label for="star33" title="text" class="star-label">3 stars</label>
                                            <input type="radio" id="star22" class="star-input" name="rate" value="2" @click="put_check();" />
                                            <label for="star22" title="text" class="star-label">2 stars</label>
                                            <input type="radio" id="star11" class="star-input" name="rate" value="1" @click="put_check();" />
                                            <label for="star11" title="text" class="star-label">1 star</label>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        <span> Votre avis est {{ NotePUB.note_pub }} / 5</span>
                                    </div>
                                    
                                </div>
                            </div>

                            <br>
                            <div class="product__details__widget">
                                <div class="card">
                                    <div class="card-body">
                                        <span>Les Commantaires</span>
                                        <span class="float-right text-muted">{{ commentCount }} comments</span>
                                    </div>
                                    <div class="border-bottom"></div>
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
                                                {{ value.commentaire_pub }}
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
                                                        v-model="coment.commentaire_pub">
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
import { useRouter, useRoute } from 'vue-router';
const isLoading = ref(true)
const router = useRouter()
const route = useRoute();
const pub = ref({});
const categ = ref({});
const note = ref({});
const Countnote = ref({});
const users = ref({});
const restau = ref({});
const NotePUB = ref(null);
let userId = "";
let userCon = "";
let typeUs = ref('');
const fetchpub = async () => {
    await api.get(`/api/Publication/${route.params.id}`)
        .then((res) => {
            pub.value = res.data; console.log(route.params.id);
            console.log(pub.value.restaurationID);
            console.log(pub.value.restauration.categorieRestID);
            console.log(pub.value.restauration.usersID);
            fetchrest(pub.value.restaurationID);
            
            fetchuser(pub.value.restauration.usersID);
            fetchcateg(pub.value.restauration.categorieRestID)
            fetchcom();
            getimguser();
            isLoading.value = false;
        })
        .catch((err) => { console.error(err) })
}
const counttpub = computed(() =>{
    //publicRest.value.length
    if (NotePUB.value != null) {
        return NotePUB.value.length;
    } else {
        return 0;
    }
});
const fetchcateg = async (idcat) => {
    await api.get(`/api/CategorieRest/${idcat}`)
        .then((res) => { categ.value = res.data; })
        .catch((err) => { console.error(err) })
}
const fetchNote = async () => {
    await api.get(`/api/moyenNote/${route.params.id}`)
        .then((res) => { note.value = res.data; })
        .catch((err) => { console.error(err) })
}
const fetchNotePart = async () => {
    await api.get(`/api/notePub/${userCon}/${route.params.id}`)
        .then((res) => {
            console.log(res.data)
            if(res.data !=0){
                NotePUB.value = res.data[0];
                if (NotePUB.value.note_pub === 1) {
                    const starC = document.getElementById("star11");
                    if(starC)
                        starC.checked = true;
                }
                if (NotePUB.value.note_pub === 2) {
                    const starC = document.getElementById("star22");
                    if(starC)
                        starC.checked = true;
                }
                if (NotePUB.value.note_pub === 3) {
                    const starC = document.getElementById("star33");
                    if(starC)
                        starC.checked = true;
                }
                if (NotePUB.value.note_pub === 4) {
                    const starC = document.getElementById("star44");
                    if(starC)
                        starC.checked = true;
                }
                if (NotePUB.value.note_pub === 5) {
                    const starC = document.getElementById("star55");
                    if(starC)
                        starC.checked = true;
                }
            }
        })
        .catch((err) => { console.error(err) })
}
const fetchCountNote = async () => {
    await api.get(`/api/Countnotes/${route.params.id}`)
        .then((res) => {
            console.log(res.data)
            Countnote.value = res.data;
        })
        .catch((err) => { console.error(err) })
}
const fetchuser = async (iduser) => {
    await api.get(`/api/users/${iduser}`)
        .then((res) => { users.value = res.data; })
        .catch((err) => { console.error(err) })
}
const fetchrest = async (idrest) => {
    await api.get(`/api/Restauration/${idrest}`)
        .then((res) => { restau.value = res.data; })
        .catch((err) => { console.error(err) })
}

onMounted(() => {
    userId = localStorage.getItem('id');
    userCon = localStorage.getItem('idCon');
    //typeUs = String(localStorage.getItem('type'));
    typeUs.value = localStorage.getItem('type') || '';
    fetchpub();
    fetchNote();
    fetchCountNote();
    fetchNotePart();
    console.log(restau.value);


});

const activeTab = ref('tabs-1');
const changeTab = (tabId) => {
    activeTab.value = tabId;
};
const test_check = async () => {
    const star5 = ref({
        note_pub: document.getElementById("star5").value,
    });
    const star4 = ref({
        note_pub: document.getElementById("star4").value,
    });
    const star3 = ref({
        note_pub: document.getElementById("star3").value,
    });

    const star2 = ref({
        note_pub: document.getElementById("star2").value,
    });
    const star1 = ref({
        note_pub: document.getElementById("star1").value,
    });
    if (document.getElementById("star1").checked) {
        await api.post(`/api/AjoutNotepub/${userCon}/${pub.value.id}`, star1.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star2").checked) {
        await api.post(`/api/AjoutNotepub/${userCon}/${pub.value.id}`, star2.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })

    }
    if (document.getElementById("star3").checked) {
        console.log(star3);
        console.log(pub.value.id);
        console.log(userCon);
        await api.post(`/api/AjoutNotepub/${userCon}/${pub.value.id}`, star3.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star4").checked) {
        await api.post(`/api/AjoutNotepub/${userCon}/${pub.value.id}`, star4.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star5").checked) {
        await api.post(`/api/AjoutNotepub/${userCon}/${pub.value.id}`, star5.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
}

const put_check = async () => {
    const star5 = ref({
        note_pub: document.getElementById("star55").value,
    });
    const star4 = ref({
        note_pub: document.getElementById("star44").value,
    });
    const star3 = ref({
        note_pub: document.getElementById("star33").value,
    });

    const star2 = ref({
        note_pub: document.getElementById("star22").value,
    });
    const star1 = ref({
        note_pub: document.getElementById("star11").value,
    });
    if (document.getElementById("star11").checked) {
        await api.put(`/api/updateNotepub/${NotePUB.value.id}`, star1.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star22").checked) {
        await api.put(`/api/updateNotepub/${NotePUB.value.id}`, star2.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })

    }
    if (document.getElementById("star33").checked) {
        console.log(star3);
        console.log(pub.value.id);
        console.log(userCon);
        await api.put(`/api/updateNotepub/${NotePUB.value.id}`, star3.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star44").checked) {
        await api.put(`/api/updateNotepub/${NotePUB.value.id}`, star4.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
    if (document.getElementById("star55").checked) {
        await api.put(`/api/updateNotepub/${NotePUB.value.id}`, star5.value)
            .then(res => {
                window.location.reload();
            })
            .catch((err) => { console.error(err) })
    }
}

// comm
const listpart = ref([]);
const listuser = ref([]);
const com = ref([]);
const fetchcom = async () => {

    try {
        const res = await api.get(`/api/listeComParpub/${route.params.id}`);
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

const commentCount = computed(() => com.value.length);
const coment = ref({
    commentaire_pub: ""
})
const addcom = async () => {
    await api.post(`/api/AjoutCompub/${userCon}/${route.params.id}/`, coment.value)
        .then(res => {
            window.location.reload();
        })
        .catch((err) => { console.error(err) })
}
</script>

<style scoped>
.img_loc {
    margin-right: 6px;
    width: 20px;
    height: 20px;
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
.modSpan{
    margin-top: 15px;
}
.rate {
    float: right;
    height: 20px;
    padding: 0 10px;
	margin-top: -12px;
	
}
.rate span{
	float: left;
    height: 20px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
