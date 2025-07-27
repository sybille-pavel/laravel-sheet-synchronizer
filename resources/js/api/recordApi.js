import axios from 'axios';

export async function fetchRecords() {
    try {
        const response = await axios.get('/records');
        return response.data;
    } catch (error) {
        console.error('Ошибка при получении записей:', error);
        throw error;
    }
}

export async function clearRecords() {
    try {
        const response = await axios.post('/records/clear');
        return response.data;
    } catch (error) {
        console.error('Ошибка при получении записей:', error);
        throw error;
    }
}

export async function generateRecords() {
    try {
        const response = await axios.post('/records/generate');
        return response.data;
    } catch (error) {
        console.error('Ошибка при генерации записей:', error);
        throw error;
    }
}

export async function createRecord(data) {
    try {
        const response = await axios.post('/records', data);
        return response.data;
    } catch (error) {
        console.error('Ошибка при создании записи:', error);
        throw error;
    }
}
