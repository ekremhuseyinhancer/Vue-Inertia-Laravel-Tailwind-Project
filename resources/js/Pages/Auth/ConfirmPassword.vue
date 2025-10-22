<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import CheckBox from '../../Components/CheckBox.vue';
import ErrorMessages  from '../../Components/ErrorMessages.vue';
import SessionMessages  from '../../Components/SessionMessages.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    password:"",
});

const submit = () =>  {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="- Login"></Head>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Password Confirmation</Title>
            <p>This is a secure area of the application. Please confirm your password before continuing.</p>
        </div>
        <!-- Errors-->
         <ErrorMessages :errors="form.errors"/>
         <SessionMessages :status="status"/>
        <!-- Form-->
        <form @submit.prevent="submit" class="space-y-6">
             <InputField label="Password" type="password" icon="key" v-model="form.password"/>
             
             <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>
