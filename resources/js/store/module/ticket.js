const state = ({
    event: [],
});
const mutations = ({
    clearCart(state) {
        state.event = [];
        return true;
    },
    addCart(state, { payload }) {
        console.log(payload);
        
          state.event.push(payload.product);
        
      },
    getCart(state, payload) {
        const productInCartIndex = state.event.findIndex(
            (item) => item.product.evenementsID === payload.product.id
        );
        if (productInCartIndex < 0) 
            return -1;
        return productInCartIndex;
    }
})
export default {
    namespaced: true,
    state,
    mutations
}
