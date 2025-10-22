<script setup>
import { Head } from '@inertiajs/vue3';
import UpdateInfo from './Sections/UpdateInfo.vue';
import UpdatePassword from './Sections/UpdatePassword.vue';
import DeleteAccount  from './Sections/DeleteAccount.vue';
defineProps({
    user: Object,
    status: String,
    pageUpdate: String,
    passwordUpdate:String,

});
</script>
<template>
    <Head title="- Profile"/>
    <UpdateInfo :user="user" :status="status" :pageUpdate="pageUpdate" />
    <UpdatePassword :passwordUpdate="passwordUpdate"/>
    <DeleteAccount />
</template>
