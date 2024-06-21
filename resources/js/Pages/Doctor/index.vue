<script setup>
import NewLayout from '@/Layouts/NewLayout.vue';
import { defineProps } from 'vue';
import DataTable from '@/Components/DataTable.vue';
import NavLink from '@/Components/NavLink.vue';
import Paginated from '@/Components/Pagination.vue';
import { useForm } from '@inertiajs/vue3';
import SearchBar from '@/Components/SearchBar.vue';

</script>

<template>
    <NewLayout title="doctor">
        <template #header>
            <h1 class="font-semibold text-white text-center">
                Panel Doctor
            </h1>
        </template>
    </NewLayout>
</template>