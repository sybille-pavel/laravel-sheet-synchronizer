<script setup>
import {clearRecords, generateRecords} from "@/api/recordApi.js";
const emit = defineEmits(['table-refresh']);
async function clear()
{
    await clearRecords();
    emit('table-refresh');
}

async function generate()
{
    await generateRecords();
    emit('table-refresh');
}

</script>

<template>
    <div class="mb-4 flex items-center space-x-3">
        <button
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700"
        >
            Добавить запись
        </button>
        <button
            @click="generate"
            class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700"
        >
            Генерация
        </button>
        <button
            @click="clear"
            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
        >
            Очистить таблицу
        </button>
    </div>
</template>


<style scoped>

</style>
