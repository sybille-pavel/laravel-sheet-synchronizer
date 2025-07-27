<script setup>
import { ref, onMounted } from 'vue';

const emit = defineEmits(['saved']);

const googleSheetUrl = ref('');

// TODO: заменить на реальный fetch с сервера
onMounted(() => {
    // Пример: подгружаем ранее сохранённое значение (заглушка)
    const saved = localStorage.getItem('googleSheetUrl');
    if (saved) {
        googleSheetUrl.value = saved;
    }
});

function saveUrl() {
    // Заглушка — сохранить в localStorage (замени на API)
    localStorage.setItem('googleSheetUrl', googleSheetUrl.value);
    console.log('Сохранено:', googleSheetUrl.value);

    emit('saved', googleSheetUrl.value);
}
</script>

<template>
    <div class="mb-4 flex items-center space-x-3">
        <input
            v-model="googleSheetUrl"
            type="text"
            placeholder="Введите ссылку на гугл таблицу: https://docs.google.com/..."
            class="w-full md:w-85 px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:ring-blue-200"
        />
        <button
            @click="saveUrl"
            class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700"
        >
            Сохранить
        </button>
    </div>
</template>

<style scoped>
</style>
