<template>
    <Head title="Create Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Company
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert v-if="Object.keys($page.props.errors).length" message="Validation Errors" variant="warning">
                            <ul>
                                <li v-for="error in $page.props.errors" :key="error">
                                    {{ error }}
                                </li>
                            </ul>
                        </Alert>

                        <form @submit.prevent="create">
                            <div>
                                <InputLabel for="country_id" value="Country" />
                                <SelectInput id="country_id" :modelOptions="$page['props']['countries']" textField="name" valueField="id" class="mt-1 block w-full" v-model="form.country_id" required />
                                <InputError class="mt-2" :message="form.errors.country_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Create Company
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
import { Head, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    country_id: '',
    name: '',
    email: '',
});

const create = () => {
    form.post(route('companies.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>
