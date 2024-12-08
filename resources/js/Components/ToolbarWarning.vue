<template>

    <v-toolbar :title="content.title" style="background-color: #FFD700; color: white;"></v-toolbar>

</template>

<script setup>

    const props = defineProps({

        data:{

            type:Object,
            required:true

        }

    })

    const content = props.data;

</script>