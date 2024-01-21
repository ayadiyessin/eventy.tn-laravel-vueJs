<template>
    <div class="container form_prof" id="content">
        <form>
            <h2 class="mb-3">Inscription Participant</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="nom">Nom Participant</label>
                        <input class="form-control" type="text" name="nom" v-model="participant.nom_part"
                            @blur="checkNomValidity" />
                        <span v-if="!isValidNom(participant.nom_part) && nomBlurred" class="error">Veuillez entrer un nom
                            valide.</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
                        <label for="prenom">Prenom Participant</label>
                        <input class="form-control" type="text" name="prenom" v-model="participant.prenom_part" required
                            @blur="checkPrenomValidity" />
                        <span v-if="!isValidPrenom(participant.prenom_part) && prenomBlurred" class="error">Veuillez entrer
                            un prénom valide.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" v-model="user.email"
                            @blur="checkEmailValidity" />
                        <span v-if="!isValidEmail(user.email) && emailBlurred" class="error">Veuillez entrer une adresse
                            email valide.</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
                        <label for="password">Mot de Passe</label>
                        <input class="form-control" type="password" name="password" v-model="user.password"
                            @blur="checkpasswordValidity" />
                        <span v-if="!isValidPassword(user.password) && passwordBlurred" class="error">Le mot de passe doit
                            avoir au moins 6 caractères.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="password1">Confirmer Mot de Passe</label>
                        <input class="form-control" type="password" name="password1" v-model="user1.password" @blur="checkConfPasswordValidity" />
                        <span v-if="!isValidConfPassword(user1.password) && ConfpasswordBlurred" class="error">
                            Le mot de passe doit avoir au moins 6 caractères et correspondre au mot de passe saisi.
                        </span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
                        <label for="numTel">Numéro de téléphone</label>
                        <input class="form-control" type="text" name="numTel" v-model="telephone.numero_tell" required
                            @blur="checkNumTelValidity" />
                        <span v-if="!isValidNumTel(telephone.numero_tell) && numTelBlurred" class="error">Veuillez entrer un numéro
                            de téléphone valide.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="input">
                        <label for="adresse">Adresse</label>
                        <input class="form-control" type="text" name="adresse" v-model="user.adresse_user" required
                            @blur="checkAdresseValidity" />
                        <span v-if="!isValidAdresse(user.adresse_user) && adresseBlurred" class="error">Veuillez entrer une
                            adresse valide.</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="input">
                        <label for="ville">Ville</label>
                        <select name="ville" class="form-control" v-model="user.ville_user" @blur="checkVilleValidity">
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
                        <span v-if="!isValidVille(user.ville_user) && villeBlurred" class="error">Veuillez sélectionner une
                            ville.</span>
                    </div>
                </div>
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
const user = ref({
    email: "",
    password: "",
    image_user: "/img/img1",
    type_user: "participant",
    ville_user: "",
    adresse_user: ""
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


const participant = ref({
    nom_part: "",
    prenom_part: "",
    usersID: ""
})
const telephone = ref({
    numero_tell: "",
    usersID: ""
})
const us = ref([]);
const addUser = async () => {
    try {
        if (
            !isValidNom(participant.value.nom_part) ||
            !isValidPrenom(participant.value.prenom_part) ||
            !isValidEmail(user.value.email) ||
            !isValidPassword(user.value.password) ||
            !isValidConfPassword(user1.value.password) ||
            !isValidAdresse(user.value.adresse_user) ||
            !isValidVille(user.value.ville_user) ||
            !isValidNumTel(telephone.value.numero_tell) ||
            !isValidPhoto(user.value.image_user)
        ) {
            // Affichez une alerte si des champs sont vides
            window.Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs avant d\'enregistrer.',
            });
            return;
        }
        const resp = await api.post('/api/register/', user.value);
        us.value = resp.data;
        console.log(us.value.id)
        participant.value.usersID = us.value.id;
        telephone.value.usersID = us.value.id;

        await api.post('/api/Participants/', participant.value);

        await api.post('/api/telephones/', telephone.value);


        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: 'Enregistrement réussi !',
        }).then((result) => {
            if (result.isConfirmed) {
                location.replace("/loginPart");
            }
        })

    } catch (error) {
    }
}

const nomBlurred = ref(false);

const checkNomValidity = () => {
    nomBlurred.value = true;
};

const isValidNom = (nom) => {
    // Ajoutez ici votre logique de validation pour le nom
    return nom.trim() !== '';
};

const prenomBlurred = ref(false);

const checkPrenomValidity = () => {
    prenomBlurred.value = true;
};

const isValidPrenom = (prenom) => {
    // Ajoutez ici votre logique de validation pour le prénom
    return prenom.trim() !== '';
};

const emailBlurred = ref(false);
const checkEmailValidity = () => {
    emailBlurred.value = true;
};
const isValidEmail = (email) => {
    // Ajoutez ici votre logique de validation pour l'email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};

const passwordBlurred = ref(false);

const checkpasswordValidity = () => {
    passwordBlurred.value = true;
};
const isValidPassword = (password) => {
    // Ajoutez ici votre logique de validation pour le mot de passe
    return password.length >= 6;
};

const user1 = ref({
    password :""
})
const ConfpasswordBlurred = ref(false);

const checkConfPasswordValidity = () => {
    ConfpasswordBlurred.value = true;
};
const isValidConfPassword = (confPassword) => {
    // Access the original password using user.value.password
    return confPassword.length >= 6 && confPassword === user.value.password;
};
const adresseBlurred = ref(false);

const checkAdresseValidity = () => {
    adresseBlurred.value = true;
};

const isValidAdresse = (adresse) => {
    // Ajoutez ici votre logique de validation pour l'adresse
    return adresse.trim() !== '';
};

const villeBlurred = ref(false);

const checkVilleValidity = () => {
    villeBlurred.value = true;
};

const isValidVille = (ville) => {
    // Ajoutez ici votre logique de validation pour la ville
    return ville !== '';
};

const numTelBlurred = ref(false);

const checkNumTelValidity = () => {
    numTelBlurred.value = true;
};

const isValidNumTel = (numTel) => {
    // Ajoutez ici votre logique de validation pour le numéro de téléphone
    // Vous pouvez utiliser des expressions régulières ou d'autres conditions selon vos besoins
    return /^\d{8}$/.test(numTel);
};

const isValidPhoto = (photo) => {
    // Ajoutez ici votre logique de validation pour l'adresse
    return photo.trim() !== '/img/img1';
};
</script>

<style scoped>
.container {
    width: 600px;
    max-width: 95%;
}

.marg {
    padding-top: 30px;
}

.error {
    color: red;
    font-size: 12px;
}
</style>