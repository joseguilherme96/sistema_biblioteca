<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

//Escuta mensagem de erro e traduz para o português;
watch(form, (newValue) => {

    if (newValue.errors.email !== undefined) {

        if (newValue.errors.email == 'These credentials do not match our records.') {

            newValue.errors.email = "Usuário ou senha inválidos !"
        }

    }

})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-success">
            {{ status }}
        </div>
        <v-row>
            <v-col :cols="12" class="d-flex justify-center">
                <v-img :width="200" :height="200" aspect-ratio="1/1" 
                :src="'http://127.0.0.1:8000/storage/imagens/logo_sistema.png'"></v-img>
            </v-col>
        </v-row>
        <div class="d-flex justify-content-center">
            <small class="text-center" style="color: #310740;">Sistema de Gerenciamento para Biblioteca</small>
        </div>
        <form @submit.prevent="submit">
            <div class="mb-3 mt-5">
                <InputLabel for="email" value="Email" style="color:#310740;" />

                <TextInput id="email" type="email" class="form-control" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class=" mt-2" :message="form.errors.email" style="color:#310740;" />
            </div>

            <div class="mb-3">
                <InputLabel for="password" value="Password" style="color:#310740;" />

                <TextInput id="password" type="password" class="form-control" v-model="form.password" required
                    autocomplete="current-password" />

                <InputError class="mt-2" :message="form.errors.password" style="color:#310740;" />
            </div>

            <div class="form-check mb-3">
                <label class="form-check-label">
                    <Checkbox name="remember" v-model:checked="form.remember" class="form-check-input" />
                    <span style="color:#310740;">Lembrar senha</span>
                </label>
            </div>

            <div class="d-flex justify-content-end">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-decoration-none me-3"
                    style="color:#310740;">
                Esqueceu a senha?
                </Link>

                <PrimaryButton class="btn" style="background-color: #310740;" :class="{ 'disabled': form.processing }"
                    :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
