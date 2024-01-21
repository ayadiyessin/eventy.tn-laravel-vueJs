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
                        <span>Profile Organisateur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card form_prof">
                <form @submit.prevent="modifierproduit">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nom">Nom Organisation</label>
                                    <input class="form-control" type="text" name="nom" v-model="organisateur.nom_org" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" v-model="user.email" />
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="password">Mot de Passe</label>
                                    <input class="form-control" type="text" name="password" v-model="user.password" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input class="form-control" type="text" name="adresse" v-model="user.adresse_user" />
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <select name="ville" class="form-control" v-model="user.ville_user">
                                        <option>--ville--</option>
                                        <option value="Ariana">Ariana</option>
                                        <option value="Béja">Béja</option>
                                        <option value="Ben Arous">Ben Arous</option>
                                        <option value="Bizerte">Bizerte</option>
                                        <option value="Gabès">Gabès</option>
                                        <option value="Gafsa">Gafsa</option>
                                        <option value="Jendouba">Jendouba</option>
                                        <option value="Kairouan">Kairouan</option>
                                        <option value="Kasserine">Kasserine</option>
                                        <option value="Kebili">Kebili</option>
                                        <option value="La Manouba">La Manouba</option>
                                        <option value="Le Kef">Le Kef</option>
                                        <option value="Mahdia">Mahdia</option>
                                        <option value="Médenine">Médenine</option>
                                        <option value="Monastir">Monastir</option>
                                        <option value="Nabeul">Nabeul</option>
                                        <option value="Sfax">Sfax</option>
                                        <option value="Sidi Bouzid">Sidi Bouzid</option>
                                        <option value="Siliana">Siliana</option>
                                        <option value="Sousse">Sousse</option>
                                        <option value="Tataouine">Tataouine</option>
                                        <option value="Tozeur">Tozeur</option>
                                        <option value="Tunis">Tunis</option>
                                        <option value="Zaghouan">Zaghouan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="numTel">Numéro de téléphone</label>
                                    <input class="form-control" type="text" name="numTel" v-model="telephone.numero_tell" />
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <label for="photo">Photo </label>
                            <img :src="user.image_user" alt="Image de l'utilisateur" />

                        </div>
                        <div class="row">

                            <label for="photo">Modifier photo</label>
                            <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="modifier la photo"
                                allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                                :server="serverOptions()" />


                        </div>
                        <br />
                        <div class="card-footer">

                            <router-link class="btn btn-outline-secondary" to="/">Retour</router-link>
                            <button type="button" class="btn btn-outline-primary float-right"
                                @click="modifierUser">Modifier</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</template>

<script setup>
import api from '../config/api.js';
import { ref, onMounted } from "vue"
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
// Create FilePond component
import { useRouter } from 'vue-router';
const isLoading = ref(true)
const router = useRouter()
const userId = ref(null);
const userimg = ref(null);
const user = ref({

})
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const serverOptions = () => {
    console.log('server pond');
    return {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'GLID5IIT');
            data.append('cloud_name', 'esps');
            data.append('public_id', file.name);
            api.post('https://api.cloudinary.com/v1_1/esps/upload', data)
                .then((response) => response.data)
                .then((data) => {
                    console.log(data);
                    user.value.image_user = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error('Error uploading file:', error);
                    error('Upload failed');
                    abort();
                });
        },
    };
}

const getorg = async () => {
    await api.get(`/api/Org/${userId.value}`)
        .then(res => {
            organisateur.value = res.data[0];
            console.log(org);
        })
        .catch(error => {
            console.log(error)
        })
}
const gettell = async () => {
    await api.get(`/api/Tell/${userId.value}`)
        .then(res => {
            telephone.value = res.data[0]
        })
        .catch(error => {
            console.log(error)
        })
    isLoading.value = false;
}
const getuser = async () => {
    await api.get(`/api/users/${userId.value}`)
        .then(res => {
            user.value = res.data
            console.log(user);
        })
        .catch(error => {
            console.log(error)
        })
}
const organisateur = ref({

})
const telephone = ref({

})
const us = ref([]);
const modifierUser = async () => {
    try {

        console.log(user.value);
        await api.put(`/api/users/${user.value.id}`, user.value);
        await api.put(`/api/organisateurs/${organisateur.value.id}`, organisateur.value);
        await api.put(`/api/telephones/${telephone.value.id}`, telephone.value);
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'modification avec succés !',
        }).then((result) => {
            if (result.isConfirmed) {
                location.replace("/");
            }
        })

    } catch (error) {
    }
}
onMounted(() => {
    userId.value = localStorage.getItem('id');

    console.log(userId.value);
    getuser();
    getorg();
    gettell();
});
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
</style>
