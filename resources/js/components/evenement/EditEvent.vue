<template>
    <button type="button" class="btn btn-primary rounded-circle " @click="visible = true">
        <span>
            <i class="fa-solid fa-pen-to-square"></i>
        </span>
    </button>
    <form>
        <div class="card-body">
            <Dialog v-model:visible="visible" :style="{ width: '50rem' }">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomev" class="form-label">Nom évènement</label>
                            <input type="text" class="form-control" id="nomev" v-model="event.nom_Event" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="adressev" class="form-label">Adresse évènement</label>
                            <input type="text" class="form-control" id="adressev" v-model="event.adresse_Event" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="prixev" class="form-label">Prix évènement</label>
                            <input type="text" class="form-control" id="prixev" v-model="event.prix_Event" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nbplaceev" class="form-label">Nombre de place</label>
                            <input type="number" class="form-control" id="nbplaceev" v-model="event.nbPlace_Event" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dateev" class="form-label">Date évènement</label>
                            <input type="date" class="form-control" id="dateev" v-model="event.date_Event" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categorie" class="form-label">Catégorie Evènement</label>
                            <select class="form-control" v-model="event.categorieEventID" required>
                                <option v-for="sc in categ" :key="sc.id" :value=sc.id>{{ sc.nomcategorieEvent }} </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="photo">Image évènement</label>
                    <file-pond name="photo" ref="pond" class-name="my-pond" label-idle="Modifier la photo"
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
                <br />
                <div class="card-footer">

                    <button type="button" class="btn btn-outline-secondary" @click="cancel">Retour</button>
                    <button type="button" class="btn btn-outline-primary float-right" @click="modifierproduit">Modifier</button>
                </div>
            </Dialog>
        </div>

    </form>
</template>
<script setup>
import api from '../config/api.js';
import { ref, onMounted } from "vue"
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import Dialog from 'primevue/dialog';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
// Create FilePond component

const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);

const props = defineProps(['art'])
const visible = ref(false);
const event = ref({})
const categ = ref([]);
const getcategories = () => {

api.get('/api/CategorieEvent').then(res => {
    categ.value = res.data;
}).catch(error => {
    console.log(error)
});

}
const handleFilePondInit = async () => {
    if (event.value.photo_Event) {
        myFiles.value = [
            {
                source: event.value.photo_Event,
                options: { type: 'local' }
            }
        ]
    }
}
const loadevent = () => {
    event.value = props.art
}
onMounted(() => {
    getcategories();
    loadevent()
}
);
const modifierproduit = () => {
    api.put(`/api/Evenement/${event.value.id}`, event.value)
        .then(() => {
            visible.value = false;
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'Evènement Modifier avec succès',
            }).then((result) => {
                if (result.isConfirmed) {
                    //location.replace("/listEventOrg");
                    console.log(result);
                }
            })
            
        })
        .catch(error => {
            console.error("There was an error!", error);
        })
}
const cancel = () => {

    visible.value = false
}
const serverOptions = () => {
    console.log('server pond');
    return {
        load: (source, load, error, progress, abort, headers) => {
            var myRequest = new Request(source);
            fetch(myRequest).then(function (response) {
                response.blob().then(function (myBlob) {
                    load(myBlob);
                });
            });
        },
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'GLID5IIT');
            data.append('cloud_name', 'esps');
            data.append('public_id', file.name);
            axios.post('https://api.cloudinary.com/v1_1/esps/upload', data)
                .then((response) => response.data)
                .then((data) => {
                    console.log(data);
                    event.value.photo_Event = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error('Error uploading file:', error);
                    error('Upload failed');
                    abort();
                });
        },
    };
};
</script>
<style scoped></style>