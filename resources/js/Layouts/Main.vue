<script setup>
import { switchTheme } from '../theme';
import NevLink from '../Components/NevLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const page = usePage();
const user = computed(()=>page.props.auth.user);
const show =ref(false);
</script>

<template>
    <!-- Overlay -->
    <header class="text-white bg-slate-800">
        <nav class="flex items-center justify-between max-w-screen-lg p-6 mx-auto">
            <NevLink routeName="home" component-name="Home">Home</NevLink>

            <div class="flex items-center space-x-6 ">
                <!-- Auth -->
                <div v-if="user" class="relative">

                    <div @mouseenter="show= !show" :class="{'bg-slate-700' : show}" class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor pointer">
                        <p>{{ user.name}}</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <!-- User Dropdown Menu -->
                        <div @mouseleave="show= !show" v-show="show"  class="absolute right-0 z-50 overflow-hidden text-white border rounded-lg top-16 bg-slate-800 border-slate-100 w-60">
                            <Link :href="route('dashboard')" class="block w-full px-6 py-3 text-left hover:slate-700" :class="{'hover:bg-slate-700' : show}"  >Dashboard</Link>
                            <Link :href="route('profile.edit')" class="block w-full px-6 py-3 text-left hover:slate-700" :class="{'hover:bg-slate-700' : show}"  >Profile</Link>
                            <Link class="block w-full px-6 py-3 text-left hover:slate-700" :class="{'hover:bg-slate-700' : show}" as="button" method="post" :href="route('logout')">Logout</Link>
                        </div>
                </div>
                <!-- Guest -->
                <div v-else class="space-x-6">
                    <NevLink routeName="login" component-name="Auth/Login">Login</NevLink>
                    <NevLink routeName="register" component-name="Auth/Register">Register</NevLink>
                </div>
                <!-- Theme -->
                <button @click="switchTheme"
                        class="grid w-6 h-6 rounded-full hover:bg-slate-700 place-items-center hover:outline outline-1 outline-white" >
                        <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
            </div>
        </nav>
    </header>

    <main class="max-w-screen-lg p-6 mx-auto">
        <slot />
    </main>
</template>
