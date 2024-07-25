import { createRouter, createWebHistory } from 'vue-router';
import TaskList from '../components/task/TaskList.vue';
import Login from '../components/user/Login.vue';
import Register from '../components/user/Register.vue';

const routes = [
    { path: '/', redirect: '/login' },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/tasks', component: TaskList },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
