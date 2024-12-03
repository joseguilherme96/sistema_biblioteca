<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    nivel_acesso_id: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="container mt-5">
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="name" class="form-label" style="color: #310740;">Nome</label>
                    <input
                        id="name"
                        type="text"
                        class="form-control"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <div v-if="form.errors.name" class="invalid-feedback">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="mb-3" style="color: #310740;">
                    <label for="email" class="form-label">Email</label>
                    <input
                        id="email"
                        type="email"
                        class="form-control"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <div v-if="form.errors.email" class="invalid-feedback">
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="color: #310740;">Senha</label>
                    <input
                        id="password"
                        type="password"
                        class="form-control"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                    <div v-if="form.errors.password" class="invalid-feedback">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar senha</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        class="form-control"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                    <div v-if="form.errors.password_confirmation" class="invalid-feedback">
                        {{ form.errors.password_confirmation }}
                    </div>
                </div>

                <!--nivel de acesso-->
                <label style="color: #310740;">Nivel Acesso</label>
                <select class="form-select" aria-label="Default select example" v-model="form.nivel_acesso_id">
                    <option selected disabled>Selecione uma opção</option>
                    <option value="1">Master</option>
                    <option value="2">Aluno</option>
                    <option value="3">Professor</option>
                </select>

                <div class="d-flex justify-content-between align-items-center mt-5">
                    <Link
                        :href="route('login')"
                        class="btn btn-link"
                    >
                        Já está registrado ?
                    </Link>

                    <button
                        type="submit"
                        style="background-color: #310740; color:white"
                        class="btn btn-primary"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        CADASTRAR
                    </button>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
