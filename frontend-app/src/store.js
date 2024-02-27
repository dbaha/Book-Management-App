import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    auth: {
      token: null,
      user: null,
      isLoggedIn: false
    }
  },
  mutations: {
    login(state, { token, user }) {
      state.auth.token = token;
      state.auth.user = user;
      state.auth.isLoggedIn = true;
      localStorage.setItem('token', token);
    },
    logout(state) {
      state.auth.token = null;
      state.auth.user = null;
      state.auth.isLoggedIn = false;
      localStorage.removeItem('token');
    }
  },
  getters: {
    isLoggedIn(state) {
      return state.auth.isLoggedIn;
    }
  }
});
