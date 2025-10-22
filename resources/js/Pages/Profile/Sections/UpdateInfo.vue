<script setup>
import Container from '../../../Components/Container.vue';
import Title from '../../../Components/Title.vue';
import InputField from '../../../Components/InputField.vue';
import PrimaryBtn from '../../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../../Components/ErrorMessages.vue';
import SessionMessages from '../../../Components/SessionMessages.vue';
import { router, useForm } from '@inertiajs/vue3';
const props =defineProps({
    user: Object,
    status: String,
    pageUpdate: String,
});

const resendEmail = (e) => {
    router.post(route('verification.send'),
     {}
     ,{
        onStart: () => e.target.disabled = true,
        onFinish: () =>e.target.disabled = false,

    });
}
const form = useForm({
    name: props.user.name,
    email: props.user.email,
});

</script>
<template>
<Container class="mb-6">
    <div class="mb-6">
        <Title>Dashboard Information</Title>
        <p>Update your account's profile Information and email address.</p>
    </div>
    <ErrorMessages :errors="form.errors"/>
    <form @submit.prevent="form.patch(route('profile.info'))" class="space-y-6">
    <InputField
    label="Name"
    icon ="id-badge"
    class="w-1/2"
    v-model="form.name"
    />
    <InputField
    label="Email"
    icon ="at"
    class="w-1/2"
    v-model="form.email"
    />


    <div v-if="user.email_verified_at === null">
      <SessionMessages :status="status" />
      <span>
        Your email address will not be unverified.
      </span>
       <button @click="resendEmail" class="font-medium text-indigo-500 underline hover:text-indigo-600 disabled:text-slate-500 disabled:cursor-wait dark:text-indigo-400 dark:hover:text-indigo-500"> Click Here to re-send the verification email.</button>
    </div>
    <PrimaryBtn :disabled="form.processing">Save Changes</PrimaryBtn>
</form>
    <SessionMessages :pageUpdate="pageUpdate" />

</Container>

</template>
