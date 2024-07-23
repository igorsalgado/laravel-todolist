Ok, vamos ajustar o template do componente de login (Login.vue) para utilizar os estilos do arquivo base.css e remover as classes do Bootstrap.

frontend/src/components/Login.vue (modificado):

Snippet de código
<template>
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                    <h2 class="text-center mb-4">Login</h2>
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" v-model="form.email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" v-model="form.password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        <div v-if="error" class="error-message">{{ error }}</div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
import { reactive, ref } from 'vue';
import { useAuthStore } from '@/stores/auth.js'
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
