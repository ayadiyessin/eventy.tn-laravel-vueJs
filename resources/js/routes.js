import Accueil from './components/Accueil.vue';
import ListeEvent from './components/evenement/ListEven.vue';
import DetailleEvent from './components/evenement/ViewEvent.vue';
import ListEventOrg from './components/organisateur/ListEventOrganis.vue';
import AddEvent from './components/evenement/AddEvent.vue';
import ProfilOrg from './components/organisateur/ProfilOrganis.vue';
import LoginOrg from './components/organisateur/LoginOrg.vue';
import RegisterOrg from './components/organisateur/RegisterOrg.vue';
import LoginPart from './components/participant/LoginPart.vue';
import RegisterPart from './components/participant/RegisterPart.vue';
import LoginRest from './components/restauration/LoginRest.vue';
import RegisterRest from './components/restauration/RegisterRest.vue';

import ListePubic from './components/publication/ListePublic.vue';
import DetaillePublic from './components/publication/ViewPublic.vue';
import ListePubicRest from './components/restauration/ListePublicRest.vue';
import AddPublic from './components/publication/AddPublic.vue';
import ProfilRest from './components/restauration/ProfilRest.vue';
import ProfilParticipant from './components/participant/ProfilParticipant.vue';
import ListTicketsPart from './components/participant/ListTicketsPart.vue';
import ListEventick from './components/participant/ViewEventick.vue';
import aboutus from './components/aboutus.vue';
import Payment from './components/evenement/Payment.vue';

export const routes = [
    {
        name: 'Accueil',
        path: '/',
        component: Accueil,
    },
    {
        name: 'ListeEvent',
        path: '/listeEvent',
        component: ListeEvent,
    },
    {
        name: 'DetailleEvent',
        path: '/detailleEvent/:id',
        component: DetailleEvent,
        meta:{isAuth:true}
    },
    {
        name: 'ListEventOrg',
        path: '/listEventOrg',
        component: ListEventOrg,
    },
    {
        name: 'AddEvent',
        path: '/addEvent',
        component: AddEvent,
    },
    {
        name: 'ProfilOrg',
        path: '/profilOrg',
        component: ProfilOrg,
    },
    {
        name: 'LoginOrg',
        path: '/loginOrg',
        component: LoginOrg,
    },
    {
        name: 'RegisterOrg',
        path: '/registerOrg',
        component: RegisterOrg,
    },
    {
        name: 'LoginPart',
        path: '/loginPart',
        component: LoginPart,
    },
    {
        name: 'RegisterPart',
        path: '/registerPart',
        component: RegisterPart,
    },
    {
        name: 'LoginRest',
        path: '/loginRest',
        component: LoginRest,
    },
    {
        name: 'RegisterRest',
        path: '/registerRest',
        component: RegisterRest,
    },
    {
        name: 'ListePubic',
        path: '/ListePubic',
        component: ListePubic,
    },
    {
        name: 'DetaillePublic',
        path: '/DetaillePublic/:id',
        component: DetaillePublic,
        meta:{isAuth:true}
    },
    {
        name: 'ListePubicRest',
        path: '/ListePubicRest',
        component: ListePubicRest,
    },
    {
        name: 'AddPublic',
        path: '/AddPublic',
        component: AddPublic,
    },
    {
        name: 'ProfilRest',
        path: '/ProfilRest',
        component: ProfilRest,
    },
    {
        name: 'ProfilParticipant',
        path: '/ProfilParticipant',
        component: ProfilParticipant,
    },
    {
        name: 'ListTicketsPart',
        path: '/ListTicketsPart',
        component: ListTicketsPart,
    },
    {
        name: 'ListEventick',
        path: '/listEventick/:id',
        component: ListEventick,
    },
    {
        name: 'aboutus',
        path: '/aboutus',
        component: aboutus,
    },
    {
        name: 'payment',
        path: '/payment/:id',
        component: Payment,
    }
];
