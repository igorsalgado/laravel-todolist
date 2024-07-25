<template>
    <div class="button-container">
        <button @click="logout" class="btn-logout">Sair</button>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const authStore = useAuthStore();
        const router = useRouter();

        const logout = () => {
            authStore.logout();
            router.push('/login');
        };

        return { logout };
    },
};
</script>

<style scoped>
button {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;

}

.button-container {
    display: flex;
    justify-content: flex-end;
}

button:hover {
    background-color: #d32f2f;
}


</style>
