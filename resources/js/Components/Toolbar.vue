<template>

    <v-toolbar :title="content.title" :color="content.color ? content.color : '#310740'" style=" color: white;"></v-toolbar>

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