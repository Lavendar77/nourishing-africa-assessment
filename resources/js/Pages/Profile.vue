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
                        <h1 class="text-center">Update your Profile</h1>

                        <div v-if="profileSuccessMessage" class="mb-5 p-2 text-sm text-white bg-green-600">
                            {{ profileSuccessMessage }}
                        </div>

                        <ValidationErrors :errors="$page.props.errors" />

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
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';

const profileForm = useForm({
    country_id: '',
    name: '',
    email: '',
    mobile: '',
});

const profileSuccessMessage = '';

const user = computed(() => usePage().props.value.auth.user);
</script>

<script>
export default {
    methods: {
        fillProfileForm() {
            this.profileForm.country_id = this.user.country_id;
            this.profileForm.name = this.user.name;
            this.profileForm.mobile = this.user.mobile;
            this.profileForm.email = this.user.email;
        },
        updateProfile() {
            this.profileSuccessMessage = '';

            this.profileForm.put(route('profile.update'), {
                onSuccess: () => {
                    this.profileSuccessMessage = 'Profile Updated Succesfully';
                },
            });
        }
    },
    mounted() {
        this.fillProfileForm();
    }
}
</script>
