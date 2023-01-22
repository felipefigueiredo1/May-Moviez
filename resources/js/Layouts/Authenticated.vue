<script setup>
import { ref } from 'vue';
import RichardLogo from '@/Components/RichardLogo.vue';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen" id="body">
            <nav class="border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <RichardLogo class="block h-9 w-auto rounded-lg" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex ">
                                <BreezeNavLink :href="route('home')" :active="route().current('home')" class="text-red-600">
                                    Home
                                </BreezeNavLink>
                                <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-red-600">
                                    Dashboard
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <BreezeDropdown alig="right" width="96" widthPx="400px">
                                <template #trigger>
                                    <div class="bg-dark-gray-es w-8 text-center rounded-md">
                                        <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400" type="button">
                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="-7 0 35 20" xmlns="http://www.w3.org/2000/svg" v-if="false">
                                                <g xmlns="http://www.w3.org/2000/svg" id="Camada_2" data-name="Camada 2"><g id="Camada_1-2" data-name="Camada 1" ><path class="cls-1" d="M13.88,23.63a3.38,3.38,0,0,1-6.76,0v0h6.75Z"/><path class="cls-1" d="M18.73,18.44V17.9h0a8.15,8.15,0,0,1-1.22-.09v1.33l.59.37,1.67,1v.55H1.27v-.56l1.67-1.07.59-.37V11.33a7,7,0,0,1,7-6.94,6.75,6.75,0,0,1,2.11.33,7.2,7.2,0,0,1,1-1,7.51,7.51,0,0,0-1-.33V2.08a2.1,2.1,0,0,0-4.19,0v1.3a8.22,8.22,0,0,0-6.18,8v7.08L0,19.84v2.52H21V19.84Z"/><path class="cls-2 text-red-500" d="M25.69,9.9a7,7,0,0,1-7,7h0a7,7,0,0,1-7-7,6.89,6.89,0,0,1,1.9-4.78,5.48,5.48,0,0,1,1-.9A6.86,6.86,0,0,1,18.69,2.9,7,7,0,0,1,25.69,9.9Z"/></g></g>
                                            </svg>
                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="-7 0 35 20" xmlns="http://www.w3.org/2000/svg" v-else>
                                                <g xmlns="http://www.w3.org/2000/svg" id="Camada_2" data-name="Camada 2"><g id="Camada_1-2" data-name="Camada 1"><path class="cls-1" d="M13.88,23.63a3.38,3.38,0,0,1-6.76,0v0h6.76Z"/><path class="cls-1" d="M18.74,18.44V11.33a8.21,8.21,0,0,0-6.1-7.92V2.09a2.1,2.1,0,0,0-4.2,0V3.38a8.23,8.23,0,0,0-6.18,8v7.08L0,19.85v2.52H21V19.85Zm1,2.66H1.27v-.56L3,19.48l.58-.38V11.33a7,7,0,0,1,7-6.94h0a7,7,0,0,1,7,6.94v7.81l.59.37,1.67,1Z"/></g></g>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template #content >
                                    <div class="bg-dark-gray-sm rounded-md text-white">
                                        <div class="p-4 py-3">
                                            <h2 class="">Notificações</h2>
                                        </div>
                                        <div class="w-full pb-2">
                                            <hr class="mx-4 border-none h-0.5" style="color:#9CA3AF;border: 1px groove #9CA3AF">
                                        </div>
                                        <div>
                                            <div class="">
                                            <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <div class="flex-shrink-0">
                                                    <img class="rounded-full w-11 h-11" src="/img/richard.jpg" alt="Jese image">

                                                </div>
                                                <div class="w-full pl-3">
                                                    <div class="text-sm mb-1.5"><span class="font-semibold">Gabriel Maciel </span>comentou na sua publicação</div>
                                                    <div class="text-xs">há 35 minutos</div>
                                                    <!--                                                    <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>-->
                                                </div>
                                            </a>

                                                <a href="#" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <div class="flex-shrink-0">
                                                        <img class="rounded-full w-11 h-11" src="/img/richard.jpg" alt="Jese image">

                                                    </div>
                                                    <div class="w-full pl-3">
                                                        <div class="text-sm mb-1.5"><span class="font-semibold">Gabriel Maciel </span>comentou na sua publicação</div>
                                                        <div class="text-xs">há 35 minutos</div>
                                                        <!--                                                    <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>-->
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </BreezeDropdown>


                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class=" text-gray-400 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md  bg-dark-gray-sm hover:text-white focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <BreezeResponsiveNavLink :href="route('home')" :active="route().current('home')"  class="text-red-600">
                            Home
                        </BreezeResponsiveNavLink>
                        <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-red-600">
                            Dashboard
                        </BreezeResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-500">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1 border-gray-500 border">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button" class=" text-red-400">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-dark-gray-sm shadow " v-if="$slots.header">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 px-2">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
nav, #body {
    background: #18191A
}
/*header {*/
/*    background: #EDF4F5*/
/*}*/
</style>
