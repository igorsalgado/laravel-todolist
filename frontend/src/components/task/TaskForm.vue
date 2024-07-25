<template>
    <div class="task-form">
        <h2>Criar Nova Tarefa</h2>
        <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" id="title" v-model="title" :class="{ 'input-error': errors.title }" />
                <span v-if="errors.title" class="error-tooltip">{{ errors.title }}</span>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea id="description" v-model="description" :class="{ 'input-error': errors.description }"></textarea>
                <span v-if="errors.description" class="error-tooltip">{{ errors.description }}</span>
            </div>
            <div class="form-group">
                <label for="due_date">Data de Vencimento:</label>
                <input type="date" id="due_date" v-model="due_date" :class="{ 'input-error': errors.due_date }" />
                <span v-if="errors.due_date" class="error-tooltip">{{ errors.due_date }}</span>
            </div>
            <button type="submit">Criar Tarefa</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import { createTask } from '@/services/api';

export default {
    setup(_, { emit }) {
        const title = ref('');
        const description = ref('');
        const due_date = ref('');
        const errors = ref({});

        const submitForm = async () => {
            try {
                const response = await createTask({
                    title: title.value,
                    description: description.value,
                    due_date: due_date.value
                });
                emit('taskCreated', response.data.data);
                title.value = '';
                description.value = '';
                due_date.value = '';
                errors.value = {}; // Clear errors on success
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = error.response.data.errors;
                } else {
                    console.error('Erro ao criar tarefa:', error.response?.data || error.message);
                    alert('Erro ao criar tarefa. Verifique os dados e tente novamente.');
                }
            }
        };

        return { title, description, due_date, submitForm, errors };
    },
};
</script>

<style scoped>
@import '../../assets/form.css';
</style>
