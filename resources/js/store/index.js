import { createStore } from 'vuex'
import Ticketstore from './module/ticket'
import createPersistedState from 'vuex-persistedstate';
export default createStore({
modules: {
    Ticketstore
 },
plugins: [createPersistedState()],
})