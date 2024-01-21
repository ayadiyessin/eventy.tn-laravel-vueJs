<template>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <router-link to="/">
                            <i class="fa fa-home"></i> Accueil
                        </router-link>
                        <span>Profile Restauration</span>
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
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom_rest">Nom de Restauration</label>
                                    <input class="form-control" type="text" v-model="restauration.nom_rest" name="nom_rest"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="categorie" class="form-label">Catégorie Restauration</label>
                                    <select class="form-control" v-model="restauration.categorieRestID" required>
                                        <option v-for="sc in categories" :key="sc.id" :value=sc.id>{{ sc.nomcategorie }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" v-model="user.email" required />
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="password">Mot de Passe</label>
                                    <input class="form-control" type="password" name="password" v-model="user.password"
                                         placeholder="changer le mot de passe"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input class="form-control" type="text" name="adresse" v-model="user.adresse_user"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <select name="ville" class="form-control" v-model="user.ville_user" required>
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
                            <div class="form-group">
                                <label for="numTel">Numéro de téléphone</label>
                                <input class="form-control" type="text" name="numTel" v-model="telephone.numero_tell"
                                    required />
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
                                :server="serverOptions()"  /> 


                        </div>
                        <br />
                        <div class="card-footer">

                            <router-link class="btn btn-outline-secondary" to="/">Retour</router-link>
                            <button type="button" class="btn btn-outline-primary float-right" @click="modifierUser">Modifier</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import api from '../config/api.js';
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

const userId = ref(null);
const userimg = ref(null);
const router = useRouter()
const categories = ref([]);

const getcategories = () => {

    api.get('/api/CategorieRest').then(res => {
        categories.value = res.data;
    }).catch(error => {
        console.log(error)
    });

}


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
const restauration = ref({

})
const telephone = ref({

})

const us = ref([]);
const getrest = async () => {
    await api.get(`/api/Rest/${userId.value}`)
        .then(res => {
            restauration.value = res.data[0]
        })
        .catch(error => {
            console.log(error)
        })
}

const gettell=async()=>{
    await api.get(`/api/Tell/${userId.value}`)
    .then(res=>{
        telephone.value=res.data[0]
    })
    .catch(error=>{
        console.log(error)
    })
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

const modifierUser = async () => {
    try {
        
        console.log(user.value);
        await api.put(`/api/users/${user.value.id}`, user.value);
        await api.put(`/api/Restauration/${restauration.value.id}`, restauration.value);
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
    getcategories();
    getuser();
    getrest();
    gettell();
}
);

</script>


<style scoped></style>
