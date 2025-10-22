<script setup>
import Container from '../../../Components/Container.vue';
import Title from '../../../Components/Title.vue';
import InputField from '../../../Components/InputField.vue';
import PrimaryBtn from '../../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../../Components/ErrorMessages.vue';
import SessionMessages from '../../../Components/SessionMessages.vue';
import { router, useForm } from '@inertiajs/vue3';

const submit = () => {

    form.put(route('profile.password'),{
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
        preserveScroll: true,
    });


};
const props =defineProps({
    passwordUpdate: String,
});

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

</script>
<template>
<Container class="mb-6">
    <div class="mb-6">
        <Title>Update Password</Title>
        <p>Ensure your ar e using a long, random password to stay secure.</p>
    </div>
    <ErrorMessages :errors="form.errors"/>
    <form @submit.prevent="submit" class="space-y-6">

    <InputField
    label="Password"
    icon ="key"
    type="password"
    class="w-1/2"
    v-model="form.current_password"
    />
    <InputField
    label="New Password"
    icon ="key"
    type="password"
    class="w-1/2"
    v-model="form.password"
    />
    <InputField
    label="Confirm New Password"
    icon ="key"
    type="password"
    class="w-1/2"
    v-model="form.password_confirmation"
    />



    <PrimaryBtn :disabled="form.processing">Change Password</PrimaryBtn>
</form>
    <SessionMessages :passwordUpdate="passwordUpdate" />

</Container>

</template>
