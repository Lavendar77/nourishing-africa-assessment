<template>
    <GuestLayout>
        <Head title="Register" />

        <Alert v-if="Object.keys($page.props.errors).length" message="Validation Errors" variant="warning">
            <ul>
                <li v-for="error in $page.props.errors" :key="error">
                    {{ error }}
                </li>
            </ul>
        </Alert>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="country_id" value="Country" />
                <SelectInput id="country_id" :modelOptions="$page['props']['countries']" textField="name" valueField="id" class="mt-1 block w-full" v-model="form.country_id" required />
                <InputError class="mt-2" :message="form.errors.country_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="mobile" value="Mobile Number" />
                <TextInput id="mobile" type="tel" class="mt-1 block w-full" v-model="form.mobile" required autocomplete="mobile" />
                <InputError class="mt-2" :message="form.errors.mobile" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    country_id: '',
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    mobile: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
