<script setup>
import { ref } from 'vue';
import {clearRecords, createRecord, generateRecords} from "@/api/recordApi.js";
import RecordModal from '@/Pages/Table/RecordModal.vue';
import GoogleSheetControl from "@/Pages/Table/GoogleSheetControl.vue";

const emit = defineEmits(['table-refresh']);

const showModal = ref(false);
const selectedRecord = ref(null);

function openAddModal() {
    selectedRecord.value = null;
    showModal.value = true;
}

async function clear() {
    await clearRecords();
    emit('table-refresh');
}

async function generate() {
    await generateRecords();
    emit('table-refresh');
}

async function handleModalSubmit(data) {
    await createRecord(data);
    emit('table-refresh');
}
</script>

<template>
    <div class="mb-4 flex items-center space-x-3">
        <button
            @click="openAddModal"
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

    <GoogleSheetControl />

    <RecordModal
        :visible="showModal"
        :record="selectedRecord"
        @close="showModal = false"
        @submit="handleModalSubmit"
    />
</template>
