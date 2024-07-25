<template>
    <div class="task-list">
        <logout/>
            <h1>Lista de Tarefas </h1>
            <TaskForm @taskCreated="addTask" />
            <div class="task-grid">
                <div class="task-card" v-for="task in tasks" :key="task.id">
                    <TaskItem :task="task" @taskDeleted="removeTask" @taskUpdated="updateTask" />
                </div>
            </div>
        </div>
</template>

<script>
import TaskForm from './TaskForm.vue';
import TaskItem from './TaskItem.vue';
import { getTasks } from '@/services/api.js';
import Logout from "@/components/user/Logout.vue";

export default {
    components: {
        Logout,
        TaskForm,
        TaskItem
    },
    data() {
        return {
            tasks: []
        };
    },
    async created() {
        try {
            const response = await getTasks();
            this.tasks = response.data.data;
        } catch (error) {
            if (error.response && error.response.status === 401) {
                alert('Erro de autenticação. Por favor, faça login novamente.');
                this.$router.push('/login');
            } else {
                alert('Erro ao carregar tarefas');
            }
        }
    },
    methods: {
        addTask(task) {
            this.tasks.push(task);
        },
        removeTask(taskId) {
            this.tasks = this.tasks.filter(task => task.id !== taskId);
        },
        updateTask(updatedTask) {
            const index = this.tasks.findIndex(task => task.id === updatedTask.id);
            if (index !== -1) {
                this.tasks.splice(index, 1, updatedTask);
            }
        }
    }
};
</script>

<style src="../../assets/task.css"></style>
