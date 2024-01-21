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
                        <span>Profile Publication</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 form_prof">
            <div v-if="isLoading">
                <div class="load">
                    <i class="fas fa-spinner fa-spin sz"></i>
                </div>
            </div>

            <div v-else class="py-6">
                <div class="card form_prof" v-if="publicCount=== 0">
                    <div class="card-header border-transparent">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="card-title">Ajouter Publication</h3>
                            </div>

                        </div>
                    </div>
                    <!-- <span class="maClasse"> Il faux ajouter une Publication</span> -->
                    <div class="row">

                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="reference" class="form-label">Description Publication</label>
                                        <!--<input type="text" class="form-control" v-model="publication.dersc_pub" required>-->
                                        <textarea class="form-control" rows="4" cols="50" v-model="publication.dersc_pub" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="photo">Image Publication</label>
                                    <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="Ajouter une photo"
                                        allow-multiple="false" accepted-file-types="image/jpeg, image/png"
                                        v-bind:files="myFiles" :server="serverOptions()" />
                                </div>
                                <br />
                                <div class="card-footer">

                                    <router-link class="btn btn-outline-secondary" to="/">Retour</router-link>
                                    <button type="button" class="btn btn-outline-primary float-right"
                                        @click="addPub">Ajouter <i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>
                <!--  modifier-->
                <div class="card form_prof" v-else>
                    <div class="card-header border-transparent">
                        <div class="row mb-2" v-if="publicRest.archive_pub === 0" >
                            <div class="col-sm-6">
                                <h3 class="card-title">Modifier Publication</h3>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-danger float-right" @click="archiver">Archiver <i class="fa fa-archive" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="row mb-2" v-else >
                            <div class="col-sm-6">
                                <h3 class="card-title">Modifier Publication archiver</h3>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-outline-warning float-right" @click="desarchiver">Desarchiver <i class="fa fa-undo" aria-hidden="true"></i></button>
                            </div>

                        </div>
                    </div>
                    <!-- <span class="maClasse"> Il faux ajouter une Publication</span> -->
                    <div class="row">

                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="reference" class="form-label">Description Publication</label>
                                        
                                        <textarea class="form-control" rows="4" cols="50" v-model="publicRest.dersc_pub" required></textarea>
                                    </div>
                                </div>
                                <div class="row">

                                    <label for="photo_pub">Photo </label>
                                    <img :src="publicRest.photo_pub" alt="Image de la restauration" name="photo_pub"/>

                                </div>
                                <div class="row">
                                    <label for="photo">Image Publication</label>
                                    <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="Modifier une photo"
                                        allow-multiple="false" accepted-file-types="image/jpeg, image/png"
                                        v-bind:files="myFiles" :server="serverOptions1()" />
                                </div>
                                <br />
                                <div class="card-footer">

                                    <router-link class="btn btn-outline-secondary" to="/">Retour</router-link>
                                    <button type="button" class="btn btn-outline-primary float-right"
                                        @click="ModiferPub">Modifier </button>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue"
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import api from '../config/api.js';
const isLoading = ref(true)
let uss = "";
let usCon = "";

const Rest = ref([]);

const getRest = async () => {
    await api.get(`/api/Rest/${uss}`)
        .then(res => {
            Rest.value = res.data[0];
        })
        .catch(error => {
            console.log(error)
        })
}
const publicRest = ref(null);
const getRestPublic = async () => {
    try{
        const res = await api.get(`/api/pub/${usCon}`);
        if (res.data.length != 0)
        {publicRest.value = res.data[0];}
        isLoading.value = false
    }
        catch (error) {
        console.error(error);
    }

}

const publicCount = computed(() => {
    //publicRest.value.length
    if (publicRest.value != null) {
        return publicRest.value.length;
    } else {
        return 0;
    }
});


onMounted(() => {

    uss = localStorage.getItem('id');
    usCon = localStorage.getItem('idCon');
    getRest();
    getRestPublic();
}
);
const publication = ref({
    dersc_pub: "",
    restaurationID: "",
    archive_pub: 0,
    photo_pub: "",

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
                    publication.value.photo_pub = data.url;
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
const serverOptions1 = () => {
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
                    publicRest.value.photo_pub = data.url;
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
const addPub = async () => {
    try {
        publication.value.restaurationID = Rest.value.id;
        const resp = await api.post('/api/Publication/', publication.value);
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Ajout avec succes !',
            showConfirmButton: false, // Cacher le bouton de confirmation
            timer: 2000 // Le message disparaîtra après 2 secondes
        }).then(() => {
            window.location.reload();
        });


    } catch (error) {
    }
}

const ModiferPub = async () => {
    try {
        console.log(publicRest.value.id);
        await api.put(`/api/Publication/${publicRest.value.id}`, publicRest.value);
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'modification avec succes !',
            showConfirmButton: false, // Cacher le bouton de confirmation
            timer: 2000 // Le message disparaîtra après 2 secondes
        }).then(() => {
            window.location.reload();
        });

    } catch (error) {
    }
}
const archiver = async () => {
    try {
        console.log(publicRest.value.id);
        await api.put(`/api/archiver/${publicRest.value.id}`, publicRest.value);
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Publication archiver ',
            showConfirmButton: false, // Cacher le bouton de confirmation
            timer: 2000 // Le message disparaîtra après 2 secondes
        }).then(() => {
            window.location.reload();
        });

    } catch (error) {
    }
}

const desarchiver = async () => {
    try {
        console.log(publicRest.value.id);
        await api.put(`/api/desarchiver/${publicRest.value.id}`, publicRest.value);
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Publication desarchiver ',
            showConfirmButton: false, // Cacher le bouton de confirmation
            timer: 2000 // Le message disparaîtra après 2 secondes
        }).then(() => {
            window.location.reload();
        });

    } catch (error) {
    }
}
</script>

<style scoped>
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
.load{
    margin-left: 50%;
    margin-right: 50%;
    margin-top: 20%;
    margin-bottom: 20%;
}
.sz{
    font-size: 40px;
}

</style>
