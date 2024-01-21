import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./routes";
import 'bootstrap/dist/css/bootstrap.min.css'
import '../css/app.css'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'
import "@fortawesome/fontawesome-free/css/all.css";
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2';
import store from "./store"
window.Swal = Swal;

import App from './App.vue'
let app = createApp(App)

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})
router.beforeEach(async (to, from, next) => {
    if (to.matched.some(record => record.meta.isAuth)) {
        let token = localStorage.getItem('token');
        if (!token) {
            next("/");
        } else {
            console.log(token);
            next(); // Mettre next() ici après avoir vérifié l'authentification
        }
    } else {
        next(); // Mettre next() ici si la route n'a pas besoin d'authentification
    }
});
app.use(router).use(PrimeVue);
app.use(store);
app.mount("#app")

