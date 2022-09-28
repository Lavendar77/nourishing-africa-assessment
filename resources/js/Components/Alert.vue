<script setup>
defineProps({
    message: {
        required: true,
        type: String,
    },
    variant: {
        required: false,
        type: String,
    }
});
</script>
<script>
export default {
    computed: {
        color() {
            switch (this.variant) {
                case 'warning':
                    return 'orange';
                case 'info':
                    return 'blue';
                case 'success':
                    return 'green';
                case 'danger':
                    return 'red';
                default:
                    return 'gray';
            }
        }
    }
}
</script>

<template>
    <div :class="`bg-${color}-100 border-l-4 border-${color}-500 text-${color}-700 p-4 my-4`" role="alert">
        <p class="font-bold">{{ message }}</p>

        <slot></slot>
    </div>

</template>
