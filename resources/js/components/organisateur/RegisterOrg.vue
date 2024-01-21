<template>
    <div class="container form_prof" id="content">
        <form>
            <h2 class="mb-3">Inscription Organisateur</h2>
            <div class="input">
                <label for="nom">Nom Organisation</label>
                <input class="form-control" type="text" name="nom" v-model="organisateur.nom_org" required/>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" v-model="user.email" required/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
                        <label for="password">Mot de Passe</label>
                        <input class="form-control" type="password" name="password" v-model="user.password" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="adresse">Adresse</label>
                        <input class="form-control" type="text" name="adresse" v-model="user.adresse_user" required/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
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
            <div class="input">
                <label for="numTel">Numéro de téléphone</label>
                <input class="form-control" type="text" name="numTel" v-model="telephone.numero_tell" required/>
            </div>
            <div class="input">
                <label for="photo">Photo</label>
                <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="Ajouter une photo"
                    allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                    :server="serverOptions()" />
            </div>
            <button type="button" class="mt-4 btn-pers" id="login_button" @click="addUser">
                Enregistrer
            </button>

            <div class="row marg">
                <div class="col-sm-9">
                    Vous avez déjà un compte?
                </div>
                <div class="col-sm-3 alternative-option">
                    <router-link class="nav-link" to="/loginOrg">Connexion</router-link>
                </div>
            </div>
        </form>
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

const router = useRouter()
const user=ref({
        email:"",
        password:"",
        image_user:"/img/img1",
        type_user:"organisateur",
        ville_user:"",
        adresse_user:""
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


const organisateur =ref({
        nom_org:"",
        usersID:""
    })
const telephone = ref({
        numero_tell:"",
        usersID:""
    })
const us = ref([]);
const addUser=async()=>{
    try {
        const resp = await api.post('/api/register/', user.value);
        us.value = resp.data;
        console.log(us.value.id)
        organisateur.value.usersID = us.value.id;
        telephone.value.usersID = us.value.id;

        await api.post('/api/organisateurs/', organisateur.value);

        await api.post('/api/telephones/', telephone.value);

            //router.replace({ name: 'LoginOrg' })
        router.push("/loginOrg")

    } catch (error) {
        }
}
</script>

<style scoped>
    .container {
        width: 600px;
        max-width: 95%;
    }

    .marg {
        padding-top: 30px;
    }
</style>