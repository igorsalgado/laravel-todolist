<template>
    <div class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                    <h2 class="text-center mb-4">Registro</h2>
                    <form @submit.prevent="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" v-model="form.name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" v-model="form.email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" v-model="form.password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" v-model="form.password_confirmation" class="form-control" id="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrar</button>
                        <div v-if="error" class="alert alert-danger mt-3">{{ error }}</div>
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
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });
        const error = ref(null);
        const authStore = useAuthStore();
        const router = useRouter();

        const register = async () => {
            try {
                await authStore.register(form);
                router.push('/login');
            } catch (err) {
                error.value = err.response?.data?.message || 'Ocorreu um erro durante o registro.';
            }
        };

        return { form, error, register };
    },
};
</script>
