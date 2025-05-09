<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-gradient-to-br from-black to-gray-800 text-white overflow-hidden flex flex-col items-center">
        <!-- Navigation -->
        <nav class="w-full max-w-6xl mx-auto p-6 flex justify-between items-center relative z-10">
            <div class="font-bold text-xl">UNIFEIN</div>
            <div class="flex gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="text-white bg-transparent border-none cursor-pointer text-base py-2 px-2"
                >
                    Dashboard
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-white bg-transparent border-none cursor-pointer text-base py-2 px-2"
                    >
                        Login
                    </Link>
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="bg-blue-600 text-white border-none py-2 px-4 rounded text-base cursor-pointer hover:bg-blue-700"
                    >
                        SignUp
                    </Link>
                </template>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center px-6 relative z-10 max-w-4xl text-center">
            <h1 class="text-4xl font-bold mb-4 leading-tight md:text-5xl">
                Budget smarter, live easier—<br>
                track your expenses in seconds
            </h1>

            <p class="text-gray-300 mb-8 max-w-3xl">
                Take control of your finances with our intuitive budget tracker, designed
                specifically for university students to help you manage your expenses
                and save smarter.
            </p>
        </div>

        <!-- Wave Graphic -->
        <div class="absolute bottom-0 left-0 w-full h-1/2 pointer-events-none">
            <svg ref="waveSvg" class="w-full h-full absolute bottom-0 opacity-80" viewBox="0 0 1440 800" preserveAspectRatio="none"></svg>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';

export default {
    setup() {
        const waveSvg = ref(null);

        onMounted(() => {
            // Generate wave lines dynamically
            for (let i = 0; i < 30; i++) {
                const y = 300 + i * 15;
                const opacity = i < 10 ? 0.2 + i * 0.08 : 1 - (i - 10) * 0.05;
                const color = i < 15 ?
                    `rgba(50, 150, ${200 + i * 3}, ${opacity})` :
                    `rgba(220, 220, 220, ${opacity * 0.3})`;

                const path = document.createElementNS("http://www.w3.org/2000/svg", "path");
                path.setAttribute("d", `M0,${y} C300,${y - 50} 600,${y + 50} 1440,${y - 20}`);
                path.setAttribute("fill", "none");
                path.setAttribute("stroke", color);
                path.setAttribute("stroke-width", "1.5");

                waveSvg.value.appendChild(path);
            }
        });

        return {
            waveSvg
        };
    }
};
</script>
