<template>
    <Head title="Edit Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Company - {{ company.name }}
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

                        <form @submit.prevent="update">
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
                                    Update Company
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
import { computed } from '@vue/runtime-core';

const form = useForm({
    country_id: usePage().props.value.company.country_id,
    name: usePage().props.value.company.name,
    email: usePage().props.value.company.email,
});

const company = computed(() => usePage().props.value.company);

const update = () => {
    form.put(route('companies.update', { 'company': usePage().props.value.company.id }), {
        onSuccess: () => form.reset(),
    });
}
</script>
