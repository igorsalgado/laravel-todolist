<template>
    <div class="task-item">
        <h3>{{ task.title }}</h3>
        <p>{{ task.description }}</p>
        <p>Vence: {{ formattedDueDate }}</p>
        <p :class="statusClass">Status: {{ task.status ? 'Completa' : 'Incompleta' }}</p>
        <div class="button-container">
            <button @click="editTask" class="btn btn-edit">Editar</button>
            <button @click="deleteTask" class="btn btn-delete">Deletar</button>
            <button @click="completeTask" v-if="!task.status" class="btn btn-complete">Completar</button>
        </div>
        <div v-if="isEditing" class="edit-form">
            <h4>Editar Tarefa</h4>
            <form @submit.prevent="updateTask">
                <div class="form-group">
                    <label for="title">Título:</label>
                    <input type="text" id="title" v-model="editTitle" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea id="description" v-model="editDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="due_date">Data de Vencimento:</label>
                    <input type="date" id="due_date" v-model="editDueDate" required>
                </div>
                <button type="submit" class="btn btn-save">Salvar</button>
                <button @click="isEditing = false" class="btn btn-cancel">Cancelar</button>
            </form>
        </div>
    </div>
</template>

<script>
import {ref, computed} from 'vue';
import {updateTask, deleteTask, completeTask} from '@/services/api.js';

export default {
    props: {
        task: Object,
    },
    setup(props, {emit}) {
        const isEditing = ref(false);
        const editTitle = ref(props.task.title);
        const editDescription = ref(props.task.description);
        const editDueDate = ref(props.task.due_date);

        const editTask = () => {
            isEditing.value = true;
        };

        const deleteTaskHandler = async () => {
            try {
                await deleteTask(props.task.id);
                emit('taskDeleted', props.task.id);
            } catch (error) {
                console.error('Erro ao deletar tarefa:', error);
            }
        };

        const completeTaskHandler = async () => {
            try {
                await completeTask(props.task.id);
                emit('taskUpdated', {...props.task, status: true});
            } catch (error) {
                console.error('Erro ao completar tarefa:', error);
            }
        };

        const updateTaskHandler = async () => {
            try {
                await updateTask(props.task.id, {
                    title: editTitle.value,
                    description: editDescription.value,
                    due_date: editDueDate.value,
                });
                props.task.title = editTitle.value;
                props.task.description = editDescription.value;
                props.task.due_date = editDueDate.value;
                isEditing.value = false;
                emit('taskUpdated', props.task);
            } catch (error) {
                console.error('Erro ao atualizar tarefa:', error);
            }
        };

        const formattedDueDate = computed(() => {
            const date = new Date(props.task.due_date);
            const options = {day: '2-digit', month: 'short', year: 'numeric'};
            return date.toLocaleDateString('pt-BR', options);
        });

        const statusClass = computed(() => {
            return props.task.status ? 'status-complete' : 'status-incomplete';
        });

        return {
            isEditing,
            editTitle,
            editDescription,
            editDueDate,
            editTask,
            deleteTask: deleteTaskHandler,
            completeTask: completeTaskHandler,
            updateTask: updateTaskHandler,
            formattedDueDate,
            statusClass
        };
    },
};
</script>

<style scoped>
@import '../../assets/item.css';
</style>
