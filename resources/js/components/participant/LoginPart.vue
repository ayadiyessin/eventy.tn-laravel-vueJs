<template>
    <div class="container form_prof" id="content">
        <form>
            <h2 class="mb-3">Connexion Participant</h2>
            <div class="input">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" v-model="user.email" @blur="checkEmailValidity" />
                <span v-if="!isValidEmail(user.email) && emailBlurred" class="error">Veuillez entrer une adresse email
                    valide.</span>
            </div>
            <div class="input">
                <label for="password">Mot de Passe</label>
                <input class="form-control" type="password" name="password" v-model="user.password"
                    @blur="checkpasswordValidity" />
                <span v-if="!isValidPassword(user.password) && passwordBlurred" class="error">Le mot de passe doit avoir au
                    moins 6 caractères.</span>
            </div>
            <button type="button" class="mt-4 btn-pers" id="login_button" @click="handleLogin">
                Connexion
            </button>
            <div class="row marg">
                <div class="col-sm-9">
                    Vous n'avez pas de compte ?
                </div>
                <div class="col-sm-3 alternative-option">
                    <router-link class="nav-link" to="/registerPart">Inscription</router-link>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import api from '../config/api.js';
import { ref, onMounted } from "vue"
import { useRouter } from 'vue-router';
const router = useRouter()
const user = ref({
    email: "",
    password: "",
    type_user: "participant"
})
const handleLogin = async () => {
    if (
        !isValidEmail(user.value.email) ||
        !isValidPassword(user.value.password)
    ) {
        // Affichez une alerte si des champs sont vides
        window.Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Veuillez remplir tous les champs avant d\'enregistrer.',
        });
        return;
    }

    const getpart=async(idp)=>{
        const rep = await api.get(`/api/Partic/${idp}`)
        const x = rep.data[0].id;
        console.log(x)
        return x;
    }
    api.post('/api/login/', user.value)
        .then((response) => {
            console.log(response.data);
            localStorage.setItem('token', response.data.token)
            localStorage.setItem('id', response.data.user.id)
            localStorage.setItem('type', response.data.user.type_user)
            getpart(response.data.user.id)
            .then(y =>{
                console.log(y);
                localStorage.setItem('idCon', y);
            })
            .catch(error => {
                console.error(error);
            });
            
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'Connexion réussi !',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.replace("/");
                    // router.push("/")
                    // window.location.href="/";
                }
            })
        })
        .catch(err => {
            console.log(err);
            alert(err)
        })
}

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