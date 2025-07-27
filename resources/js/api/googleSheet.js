import axios from 'axios';

export async function fetchConfig() {
    try {
        const response = await axios.get('/google-sheets-config');
        return response.data;
    } catch (error) {
        console.error('Ошибка при получении конфига:', error);
        throw error;
    }
}

export async function updateConfig(sheet_url) {
    try {
        const response = await axios.post('google-sheets-config', {
            sheet_url: sheet_url
        });
        return response.data;
    } catch (error) {
        console.error('Ошибка при обновлении конфига:', error);
        throw error;
    }
}
