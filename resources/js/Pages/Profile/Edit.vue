<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineOptions({
  layout: AppLayout,
});

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-2xl text-blue-800 leading-tight">Profile Settings</h2>
        </template>

        <div class="profile-container">
            <div class="profile-content">
                <div class="profile-card">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="profile-card">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="profile-card danger-zone">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.profile-container {
    margin-left: 250px; /* Match sidebar width */
    padding: 2rem;
    min-height: 100vh;
    background-color: #f5f9ff; /* Light blue background */
}

.profile-content {
    max-width: 1200px;
    margin: 0 auto;
    padding-top: 1rem;
}

.profile-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(30, 100, 200, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
    border-left: 4px solid #3b82f6; /* Blue accent border */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(30, 100, 200, 0.15);
}

.danger-zone {
    border-left-color: #ef4444; /* Red accent for danger zone */
    background-color: #fff5f5; /* Light red background */
}

h2 {
    color: #1e40af; /* Dark blue */
    margin-bottom: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .profile-container {
        margin-left: 0;
        padding: 1rem;
    }

    .profile-card {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .profile-content {
        padding-top: 0.5rem;
    }

    .profile-card {
        padding: 1rem;
    }
}
</style>
