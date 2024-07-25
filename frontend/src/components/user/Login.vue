<template>
    <div class="auth-container">
        <div class="auth-card">
            <h2 class="text-center mb-4">Login</h2>
            <form @submit.prevent="login">
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" v-model="form.email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" v-model="form.password" class="form-control" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
                <div v-if="error" class="error-message">{{ error }}</div>
                <div class="text-center mt-3">
                    <router-link to="/register" class="btn btn-link">Criar uma conta</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const form = reactive({
            email: '',
            password: '',
        });
        const error = ref(null);
        const authStore = useAuthStore();
        const router = useRouter();

        const login = async () => {
            try {
                await authStore.login(form);
                await router.push('/tasks');
            } catch (err) {
                error.value = err.response?.data?.message || 'Ocorreu um erro durante o login.';
            }
        };

        return { form, error, login };
    },
};
</script>

<style scoped>
@import '../../assets/styles.css';
</style>
