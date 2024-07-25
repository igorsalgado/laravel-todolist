import { defineStore } from 'pinia';
import api from '@/services/api.js';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('token') || null, // Carrega o token do localStorage, se existir
        isAuthenticated: !!localStorage.getItem('token'), // Define como autenticado se houver token
    }),
    actions: {
        async login(credentials) {
            try {
                const response = await api.post('/login', credentials);
                this.user = response.data.data;
                this.token = response.data.access_token;
                this.isAuthenticated = true;
                localStorage.setItem('token', this.token);
            } catch (error) {
                console.error('Erro ao fazer login:', error.response?.data?.message || error.message);
                this.logout();
                throw error;
            }
        },
        async register(form) {
            try {
                const response = await api.post('/register', form);
                this.user = response.data.data;
                this.token = response.data.access_token;
                this.isAuthenticated = true;
                localStorage.setItem('token', this.token);
            } catch (error) {
                console.error('Erro ao registrar:', error.response?.data?.message || error.message);
                throw error;
            }
        },
        logout() {
            this.user = null;
            this.token = null;
            this.isAuthenticated = false;
            localStorage.removeItem('token');
        },
    },
});
