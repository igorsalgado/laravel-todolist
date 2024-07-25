import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000/api/v1',
});

// Interceptador para adicionar o token de autenticação
api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

// Criar tarefa
export const createTask = async (task) => {
    return api.post('/tasks', task);
};

// Atualizar tarefa
export const updateTask = async (taskId, task) => {
    return api.put(`/tasks/${taskId}`, task);
};

// Completar tarefa
export const completeTask = async (taskId) => {
    return api.patch(`/tasks/${taskId}/complete`);
};

// Deletar tarefa
export const deleteTask = async (taskId) => {
    return api.delete(`/tasks/${taskId}`);
};

// Listar tarefas
export const getTasks = async () => {
    return api.get('/tasks');
};

export default api; // Exporta o `api` como padrão
