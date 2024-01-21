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
                            <router-link to="/listEventOrg"> Liste Evènement</router-link>
                            <span>Ajouter évènement</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            <div class="card form_prof">
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomev" class="form-label">Nom évènement</label>
                                    <input type="text" class="form-control" id="nomev" v-model="evenment.nom_Event" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adressev" class="form-label">Adresse évènement</label>
                                    <input type="text" class="form-control" id="adressev" v-model="evenment.adresse_Event" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prixev" class="form-label">Prix évènement</label>
                                    <input type="text" class="form-control" id="prixev" v-model="evenment.prix_Event" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nbplaceev" class="form-label">Nombre de place</label>
                                    <input type="number" class="form-control" id="nbplaceev" v-model="evenment.nbPlace_Event" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateev" class="form-label">Date évènement</label>
                                    <input type="date" class="form-control" id="dateev" v-model="evenment.date_Event" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="categorie" class="form-label">Catégorie Evènement</label>
                                    <select class="form-control" v-model="evenment.categorieEventID" required>
                                        <option v-for="sc in categories" :key="sc.id" :value=sc.id>{{ sc.nomcategorieEvent }} </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label for="photo">Image évènement</label>
                            <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="Ajouter une photo"
                                allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                                :server="serverOptions()" />
                        </div>
                        <br />
                        <div class="card-footer">
                            
                            <router-link class="btn btn-outline-secondary" to="/listEventOrg">Retour</router-link>
                            <button type="button" class="btn btn-outline-primary float-right" @click="addEvent">Enregistrer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue"
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import api from '../config/api.js';
import { useRouter } from 'vue-router';

const router = useRouter()
const categories = ref([]);
let uss="";

const getcategories = () => {

    api.get('/api/CategorieEvent').then(res => {
        categories.value = res.data;
    }).catch(error => {
        console.log(error)
    });

}
const org=ref([]);
const getorg=async()=>{
    await api.get(`/api/Org/${uss}`)
    .then(res=>{
        org.value=res.data[0];
    })
    .catch(error=>{
        console.log(error)
    })
}
onMounted(() => {
    getcategories();
    uss = localStorage.getItem('id');
    getorg();
}
);
const evenment = ref({
    nom_Event: "",
    categorieEventID: "",
    organisateursID: "",
    nbPlace_Event:"",
    date_Event:"",
    prix_Event:"",
    adresse_Event:"",
    photo_Event:""
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
                    evenment.value.photo_Event = data.url;
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


const addEvent=async()=>{
    try {
        evenment.value.organisateursID=org.value.id;
        const resp = await api.post('/api/Evenement/', evenment.value);
        //router.push("/listEventOrg")
        Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'Evènement Ajouter avec succès',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.replace("/listEventOrg");
                }
            })

    } catch (error) {
        }
}
</script>

<style scoped></style>