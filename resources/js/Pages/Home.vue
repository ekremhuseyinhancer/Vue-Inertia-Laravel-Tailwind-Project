<script setup>
import SessionMessages from '../Components/SessionMessages.vue';
import Card from '../Components/Card.vue';
import PaginationLinks from '../Components/PaginationLinks.vue';
import InputField from '../Components/InputField.vue';
import { router, useForm } from '@inertiajs/vue3';


const params = route().params;

const props = defineProps({
    listings:Object,
    searchTerm:String,
    deleteStatus: String,
});
const form = useForm({
    search: props.searchTerm,
});

const username = params.user_id ? props.listings.data.find(i=>i.user_id === Number(params.user_id)).user.name : null;


const search = () =>{
    router.get(route('home'),{
        search: form.search,
        user_id: params.user_id,
        tag: params.tag,

    });
};
</script>

<template>
    <Head title="-Latest Listings"></Head>

    <SessionMessages :deleteStatus="deleteStatus" />

    <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <Link
                class="flex items-center gap-2 px-2 py-1 text-white bg-indigo-500 rounded-md px-"
                v-if="params.tag" :href="route('home',{...params, tag: null, page:null})"
                >
                    {{ params.tag }}
                <i class="fa-solid fa-xmark"></i>
                </Link>
                <Link
                class="flex items-center gap-2 px-2 py-1 text-white bg-indigo-500 rounded-md px-"
                v-if="params.search" :href="route('home',{...params, search: null, page:null})"
                >
                    {{ params.search }}
                <i class="fa-solid fa-xmark"></i>
                </Link>
                <Link
                class="flex items-center gap-2 px-2 py-1 text-white bg-indigo-500 rounded-md px-"
                v-if="params.user_id" :href="route('home',{...params, user_id: null, page:null})"
                >
                    {{ username }}
                <i class="fa-solid fa-xmark"></i>
                </Link>
            </div>
            <div class="w-1/4">
                <form @submit.prevent="search">
                    <InputField
                        type="search"
                        label=""
                        icon="magnifying-glass"
                        placeholder="Search"
                        v-model="form.search"
                    />
                </form>
            </div>
    </div>

    <div v-if="Object.keys(listings.data).length">
        <div class="grid grid-cols-3 gap-4">
            <div v-for="listing in listings.data" :key="listing.id">
                <Card :listing="listing"/>
            </div>
        </div>
        <div class="mt-8">
            <PaginationLinks :paginator="listings"/>
        </div>
    </div>
    <div v-else>
        There is no listings.
    </div>
</template>
