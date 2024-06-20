<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { hasRole } from '@/rolePermission';

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>

        <Head :title="title" />
        <Banner />

        <!-- *Navegación Superior -->
        <div class="min-h-screen bg-gray-100">
            <!-- *Navegación Superior -->
            <!-- *Page Heading -->
            <header v-if="$slots.header" class="bg-gray-800 shadow py-4">
                <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <!-- Logo en la izquierda -->
                    <div class="flex items-center">
                        <!-- <img src="https://golsystems.mx/img/logoheader.png" alt="Logo" class="h-10 mr-2" />  CREAR LOGO PARA COLOCAR-->
                    </div>
                    <!-- Título del slot en el centro -->
                    <div v-if="hasRole('administrador') || hasRole('doctor')">
                        <div class="flex-grow text-center">
                            <slot name="header" />
                        </div>
                    </div>
                    <div v-else>
                        <div class="flex-grow text-center mr-60">
                            <slot name="header" />
                        </div>
                    </div>
                    <div>
                        <div class="ml-auto mb-8">
                            <!-- *Configuracion Dropdown 
                                        *Se crea un dropdown para poder acceder a la configuraciones del usuario-->
                            <div class="absolute right-0 w-52">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                :src="$page.props.auth.user.profile_photo_url"
                                                :alt="$page.props.auth.user.name">
                                            <div class="text-white mt-1 ml-2 flex items-center w-32">
                                                <span class="truncate">
                                                    {{ $page.props.auth.user.name }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-down svg-icon">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </div>
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- *Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <DropdownLink :href="route('profile.show')">
                                            Profile
                                        </DropdownLink>

                                        <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                            :href="route('api-tokens.index')">
                                            API Tokens
                                        </DropdownLink>

                                        <div class="border-t border-gray-200" />

                                        <!-- *Authentication -->
                                        <form @submit.prevent="logout">
                                            <DropdownLink as="button">
                                                Log Out
                                            </DropdownLink>
                                        </form>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="bg-gray-100">
                <nav class="bg-gray-100">
                    <!-- *Contenido de todo el el siderbard -->
                    <div class="flex">
                        <!-- *Siderbard -->
                        <div v-if="hasRole('administrador') || hasRole('doctor')"
                            class="flex flex-col bg-gray-800 shadow min-h-screen">
                            <div class="space-y-2">
                                <div>
                                    <div class="py-1">
                                        <!-- *Muestra las opciones o direcciones a las que se puede acceder
                                     *Las direcciones solo les apareceran dependiendo de su rol de sistema-->
                                        <div>
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('dashboard')" :active="route().current('dashboard')">
                                                Dashboard
                                            </a>
                                        </div>
                                        <!-- *Las del Administrador-->
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.index')" :active="route().current('Admin.index')">
                                                Visualizar citas
                                            </a>
                                        </div>
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.create')"
                                                :active="route().current('admin.create')">
                                                Cear citas
                                            </a>
                                        </div>
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.cancel')"
                                                :active="route().current('admins.cancel')">
                                                Cancelar citas
                                            </a>
                                        </div>
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.update')"
                                                :active="route().current('admins.update')">
                                                Actualizar cita
                                            </a>
                                        </div>
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.downloadQuote')"
                                                :active="route().current('admins.downloadQuote')">
                                                Descargar hoja de cita
                                            </a>
                                        </div>
                                        <div v-if="hasRole('administrador')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('admins.schedules')"
                                                :active="route().current('admins.schedules')">
                                                Horarios disponibles
                                            </a>
                                        </div>
                                        <!-- *Las del Doctor-->

                                        <div v-if="hasRole('doctor')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('doctors.index')" :active="route().current('doctors.index')">
                                                Visualizar citas
                                            </a>
                                        </div>
                                        <div v-if="hasRole('doctor')">
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 dark:hover:bg-gray-100 dark:hover:text-gray-900"
                                                :href="route('doctors.schedules')"
                                                :active="route().current('doctors.schedules')">
                                                Horarios disponibles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page Content -->
                        <main class="flex-1 overflow-y-auto flex flex-col">
                            <!-- <main class="flex-1 overflow-y-auto ml-60"> -->
                            <slot />
                            <!-- Footer -->
                            <footer class="bg-gray-100 text-gray-500 text-sm ml-12 py-6 mt-auto">
                                Desarrollado por <span class="text-red-500"></span>Eduardo Narez.
                                Copyright ©2023. All rights reserved License.
                            </footer>
                        </main>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>