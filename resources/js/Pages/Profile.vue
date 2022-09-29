<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="font-bold text-xl mb-4 text-center text-gray-800">Update your Profile</h1>

                        <Alert v-if="$page.props.flash.message" :message="$page.props.flash.message" variant="success" />

                        <Alert v-if="Object.keys($page.props.errors).length" message="Validation Errors" variant="warning">
                            <ul>
                                <li v-for="error in $page.props.errors" :key="error">
                                    {{ error }}
                                </li>
                            </ul>
                        </Alert>

                        <form @submit.prevent="updateProfile">
                            <div>
                                <InputLabel for="country_id" value="Country" />
                                <SelectInput id="country_id" :modelOptions="$page['props']['countries']" textField="name" valueField="id" class="mt-1 block w-full" v-model="profileForm.country_id" required />
                                <InputError class="mt-2" :message="profileForm.errors.country_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="profileForm.name" required autocomplete="name" />
                                <InputError class="mt-2" :message="profileForm.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="profileForm.email" required autocomplete="username" />
                                <InputError class="mt-2" :message="profileForm.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="mobile" value="Mobile Number" />
                                <TextInput id="mobile" type="tel" class="mt-1 block w-full" v-model="profileForm.mobile" required autocomplete="mobile" />
                                <InputError class="mt-2" :message="profileForm.errors.mobile" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': profileForm.processing }" :disabled="profileForm.processing">
                                    Update Profile
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>

                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="font-bold text-xl mb-4 text-center text-gray-800">Update your Password</h1>

                        <form @submit.prevent="updatePassword">
                            <div class="mt-4">
                                <InputLabel for="old_password" value="Old Password" />
                                <TextInput id="old_password" type="password" class="mt-1 block w-full" v-model="passwordForm.old_password" required />
                                <InputError class="mt-2" :message="passwordForm.errors.old_password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="new_password" value="New Password" />
                                <TextInput id="new_password" type="password" class="mt-1 block w-full" v-model="passwordForm.new_password" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="passwordForm.errors.new_password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="new_password_confirmation" value="Confirm New Password" />
                                <TextInput id="new_password_confirmation" type="password" class="mt-1 block w-full" v-model="passwordForm.new_password_confirmation" required autocomplete="new-password" />
                                <InputError class="mt-2" :message="passwordForm.errors.new_password_confirmation" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': passwordForm.processing }" :disabled="passwordForm.processing">
                                    Update Password
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Alert from '@/Components/Alert.vue';
import { Head, useForm, usePage } from '@inertiajs/inertia-vue3';

const profileForm = useForm({
    country_id: usePage().props.value.auth.user.country_id,
    name: usePage().props.value.auth.user.name,
    email: usePage().props.value.auth.user.email,
    mobile: usePage().props.value.auth.user.mobile,
});

const passwordForm = useForm({
    old_password: '',
    new_password: '',
    new_password_confirmation: '',
});

const updateProfile = () => {
    profileForm.put(route('profile.update'));
};

const updatePassword = () => {
    passwordForm.post(route('profile.password.update'), {
        onBefore: () => confirm('Are you sure you want to change your password?'),
        onSuccess: () => passwordForm.reset(),
    });
};
</script>
