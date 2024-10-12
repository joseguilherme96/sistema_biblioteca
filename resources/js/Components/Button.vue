<template>

    <v-btn variant="flat" color="#310740">{{ nome }}</v-btn>

</template>
<script setup>

defineProps({

    nome:{

        type: String,
        required:true

    }


})

</script>