import AuthService from "@/services/AuthService";
import { defineStore } from "pinia";
import axios from 'axios';

export const useAuthStore = defineStore("authStore", {
  state: () => {
    return {
      user: null,
      errors: {},
    };
  },
  actions: {
    
    /******************* Get authenticated user *******************/
    async getUser() {
      if (localStorage.getItem("token")) {
        try {
          const response = await AuthService.getUser();
          this.user = response.data;
          console.log(response)
        } catch (error) {
          console.error(error);
        }
      }
    },

    /******************* Login or Register user *******************/
    async authenticate(apiRoute, formData) {
      try {
        const response = await AuthService.authenticate(apiRoute, formData);
        if (response.data.errors) {
          this.errors = response.data.errors;
        } else {
          this.errors = {};
          localStorage.setItem("token", response.data.token);
          axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
          this.user = response.data.user;
          this.router.push({ name: "dashboard" });
        }
      } catch (error) {
        this.errors = error.response?.data?.errors
        console.error(error);
      }
    },
    /******************* Logout user *******************/
    async logout() {
      try {
        const response = await AuthService.logout();
        this.user = null;
        this.errors = {};
        localStorage.removeItem("token");
        axios.defaults.headers.common['Authorization'] = `Bearer ${null}`;
        this.router.push({ name: "login" });
        console.log(response)
      } catch (error) {
        console.error(error);
      }
    },
  },
});