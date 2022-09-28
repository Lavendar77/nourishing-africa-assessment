<script setup>
defineProps(['errors']);
</script>

<template>
    <div v-if="Object.keys(errors).length" class="mb-5 p-2 text-sm text-white bg-red-600">
        <ul>
            <li v-for="error in $page.props.errors" :key="error">
                {{ error }}
            </li>
        </ul>
    </div>
</template>
