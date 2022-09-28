<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="font-bold text-xl mb-4 text-center text-gray-800">
                            Your Companies<br>
                            <Link v-if="$page.props.companies.length < 3" :href="route('companies.create')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Create Company
                            </Link>
                        </h1>

                        <Alert v-if="$page.props.companies.length < 1" message="No companies registered yet" variant="warning" />

                        <div class="flex">
                            <div
                                class="flex-auto max-w-sm border-l-4 border-blue-500 rounded overflow-hidden shadow-lg mr-3"
                                v-for="company in $page.props.companies"
                                :key="company.id"
                                :class="{ 'bg-red-200 opacity-75': company.deleted_at }"
                            >
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ company.name }}</div>
                                    <p class="text-gray-700 text-base">
                                        In: {{ company.country.name }}
                                    </p>
                                    <Link :href="`mailto:${company.email}`" class="underline text-sm text-gray-600 hover:text-gray-900">
                                        {{ company.email }}
                                    </Link>
                                </div>
                                <div class="flex justify-between px-6 pt-4 pb-2">
                                    <Link
                                        :href="route('companies.edit', { 'company': company.id })"
                                        class="text-sm text-gray-600 hover:text-gray-900"
                                        v-if="!company.deleted_at"
                                    >
                                        Edit
                                    </Link>
                                    <button
                                        @click="company.deleted_at ? restoreCompany(company.id) : deleteCompany(company.id)"
                                        class="text-sm text-red-600 hover:text-red-900"
                                        :class="{ 'text-blue-600 hover:text-blue-900': company.deleted_at }"
                                    >
                                        {{ company.deleted_at ? 'Restore' : 'Delete' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import Alert from '@/Components/Alert.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<script>
export default {
    methods: {
        deleteCompany(id) {
            this.$inertia.delete(route('companies.destroy', { 'company': id }), {
                onBefore: () => confirm('Are you sure you want to delete this company?'),
            })
        },
        restoreCompany(id) {
            this.$inertia.post(route('companies.restore', { 'company': id }), null, {
                onBefore: () => confirm('Are you sure you want to restore this company?'),
            })
        }
    }
}
</script>