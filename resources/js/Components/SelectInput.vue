<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    'modelOptions': {
        required: true,
        type: Array,
    },
    'valueField': {
        required: false,
        type: String,
    },
    'textField': {
        required: false,
        type: String,
    },
    'modelValue': {
        required: false,
        type: String,
    }
});

defineEmits(['update:modelValue']);

const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});
</script>

<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" @change="$emit('update:modelValue', $event.target.value)" ref="select">
        <option value="">-- Select an option --</option>
        <option
            :value="valueField ? modelOption[valueField] : modelOption.value"
            v-for="(modelOption, index) in modelOptions"
            :key="index"
            :selected="modelValue == modelOption"
        >
            {{ textField ? modelOption[textField] : modelOption.text }}
        </option>
    </select>
</template>
