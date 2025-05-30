<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

// Particles animation (same as landing page and login)
const particles = ref([]);

onMounted(() => {
    createParticles();
});

function createParticles() {
    const particleCount = 30;

    for (let i = 0; i < particleCount; i++) {
        particles.value.push({
            id: i,
            x: Math.random() * window.innerWidth,
            y: Math.random() * window.innerHeight,
            size: Math.random() * 3 + 1,
            speedX: (Math.random() - 0.5) * 0.5,
            speedY: (Math.random() - 0.5) * 0.5,
            color: `rgba(100, 200, 255, ${Math.random() * 0.5 + 0.1})`
        });
    }

    animateParticles();
}

function animateParticles() {
    requestAnimationFrame(() => {
        particles.value.forEach(particle => {
            particle.x += particle.speedX;
            particle.y += particle.speedY;

            if (particle.x < 0 || particle.x > window.innerWidth) {
                particle.speedX *= -1;
            }
            if (particle.y < 0 || particle.y > window.innerHeight) {
                particle.speedY *= -1;
            }
        });

        animateParticles();
    });
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="min-h-screen bg-gradient-to-br from-black to-gray-800 text-white overflow-hidden flex items-center justify-center relative">
            <!-- Floating Particles -->
            <div
                v-for="particle in particles"
                :key="particle.id"
                class="absolute rounded-full pointer-events-none"
                :style="{
                    left: `${particle.x}px`,
                    top: `${particle.y}px`,
                    width: `${particle.size}px`,
                    height: `${particle.size}px`,
                    backgroundColor: particle.color,
                    boxShadow: `0 0 5px ${particle.color}`
                }"
            ></div>

            <div class="w-full max-w-md mx-auto p-6 relative z-10">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">Create Account</h1>
                    <p class="text-gray-400">Join us to start managing your finances</p>
                </div>

                <form @submit.prevent="submit" class="bg-gray-900/50 backdrop-blur-sm p-8 rounded-xl border border-gray-700 shadow-lg">
                    <div>
                        <InputLabel for="name" value="Name" class="text-gray-300" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-2 block w-full bg-gray-800 border-gray-700 text-white focus:border-blue-500 focus:ring-blue-500"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-1" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" class="text-gray-300" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-2 block w-full bg-gray-800 border-gray-700 text-white focus:border-blue-500 focus:ring-blue-500"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-1" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" class="text-gray-300" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-2 block w-full bg-gray-800 border-gray-700 text-white focus:border-blue-500 focus:ring-blue-500"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />

                        <InputError class="mt-1" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" class="text-gray-300" />

                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-2 block w-full bg-gray-800 border-gray-700 text-white focus:border-blue-500 focus:ring-blue-500"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />

                        <InputError class="mt-1" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <Link
                            :href="route('login')"
                            class="text-sm text-blue-400 hover:text-blue-300 hover:underline transition-colors"
                        >
                            Already registered?
                        </Link>

                        <button
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-all duration-300 transform hover:scale-105 disabled:opacity-50"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Register</span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Particle animation */
.particle {
    will-change: transform;
}

/* Input focus styles */
input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    transition: all 0.2s ease;
}

/* Button hover effect */
button:hover {
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

/* Smooth transitions */
a, button, input {
    transition: all 0.3s ease;
}

/* Loading spinner animation */
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
