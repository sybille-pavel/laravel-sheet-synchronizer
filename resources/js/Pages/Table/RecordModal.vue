<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    visible: Boolean,
    record: Object, // null или объект
});

const emit = defineEmits(['close', 'submit']);

const form = ref({
    content: '',
    status: 'Prohibited',
});

watch(
    () => props.record,
    (val) => {
        if (val) {
            form.value = { ...val };
        } else {
            form.value = {
                content: '',
                status: 'Prohibited',
            };
        }
    },
    { immediate: true }
);

function close() {
    emit('close');
}

function handleSubmit() {
    emit('submit', { ...form.value });
    close();
}
</script>

<template>
    <div v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">
                {{ record ? 'Редактировать запись' : 'Добавить запись' }}
            </h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Контент</label>
                    <input
                        v-model="form.content"
                        type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Статус</label>
                    <select
                        v-model="form.status"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"
                    >
                        <option value="Allowed">Allowed</option>
                        <option value="Prohibited">Prohibited</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-2">
                <button
                    @click="close"
                    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300"
                >
                    Отмена
                </button>
                <button
                    @click="handleSubmit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700"
                >
                    {{ record ? 'Сохранить' : 'Добавить' }}
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
