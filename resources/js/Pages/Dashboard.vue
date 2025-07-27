<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Table from "@/Pages/Table/Table.vue";
import TableActions from "@/Pages/Table/Actions.vue";
import {ref} from "vue";

const tableRef = ref(null);

function refresh()
{
    tableRef.value.refresh();
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Список контента
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <TableActions @table-refresh="refresh" />
                        <Table ref="tableRef"></Table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
