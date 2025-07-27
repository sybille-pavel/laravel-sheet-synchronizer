<script setup>
import {onMounted, ref} from "vue";
import {fetchRecords, updateRecord} from "@/api/recordApi.js";
import RecordModal from "@/Pages/Table/RecordModal.vue";

const items = ref([]);
const showModal = ref(false);
const selectedRecord = ref(null);

async function loadRecords() {
    items.value = await fetchRecords();
}

defineExpose({
    refresh: loadRecords,
});

onMounted(loadRecords);


function openEdit(record) {
    selectedRecord.value = {...record};
    showModal.value = true;
}

async function handleModalSubmit(updatedData) {
    await updateRecord(updatedData.id, updatedData);
    showModal.value = false;
    await loadRecords();
}
</script>

<template>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left px-4 py-2 border-b">Контент</th>
                <th class="text-left px-4 py-2 border-b">Статус</th>
                <th class="text-left px-4 py-2 border-b">Дата создания</th>
                <th class="text-left px-4 py-2 border-b">Дата обновления</th>
            </tr>
            </thead>
            <tbody>
            <tr
                v-for="(item, index) in items"
                :key="index"
                class="hover:bg-gray-50 cursor-pointer"
                @click="openEdit(item)"
            >
                <td class="px-4 py-2 border-b">{{ item.content }}</td>
                <td class="px-4 py-2 border-b">
            <span
                :class="[
                'inline-block px-2 py-1 text-xs font-medium rounded',
                item.status === 'Allowed'
                  ? 'bg-green-100 text-green-800'
                  : 'bg-yellow-100 text-yellow-800'
              ]"
            >
              {{ item.status }}
            </span>
                </td>
                <td class="px-4 py-2 border-b">{{ item.created_at }}</td>
                <td class="px-4 py-2 border-b">{{ item.updated_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Модалка -->
    <RecordModal
        :visible="showModal"
        :record="selectedRecord"
        @close="showModal = false"
        @submit="handleModalSubmit"
    />
</template>

<style scoped>
</style>
