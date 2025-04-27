<script setup>
import App from '@/Layouts/Site/App.vue'
import ContactInfo from '@/Components/Site/ContactInfo.vue'
import Preloader from '@/Components/Site/Preloader.vue';
import Toast from '@/components/Site/Toast.vue';

import { ref, watch, computed, defineProps } from 'vue'
import axios from 'axios'

const toast = ref(null);

const props = defineProps({
    extensionId: {
        type: String,
        default: ''
    },
    extensionVersion: {
        type: String,
        default: ''
    },
    uninstall: {
        type: Boolean,
        default: false
    }
})

const form = ref({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    uninstall_reason: '',
    type: "",
    extension_id: props.extensionId,
    extension_version: props.extensionVersion,
})

if (props.uninstall) {
    form.value.type = 'goodbye'
} else if (window.location.pathname.includes('feed-back')) {
    form.value.type = 'feedback'
} else {
    form.value.type = 'contact'
}

const loading = ref(false)
const success = ref(false)
const errors = ref({})

// Dynamic titles based on type
const pageTitle = computed(() => {
    switch (form.value.type) {
        case 'feedback':
        case 'suggestion':
            return { heading: 'Feedback / Suggestions', subheading: "We'd love to hear your feedback or suggestions!" }
        case 'goodbye':
            return { heading: 'We Are Sorry to See You Go', subheading: "Help us improve. Let us know why you're leaving!" }
        default:
            return { heading: 'Contact Us', subheading: "We'd love to hear from you!" }
    }
})

const submitForm = async () => {
    loading.value = true
    errors.value = {}
    success.value = false


    try {
        const payload = { ...form.value }

        const response = await axios.post('/api/user-messages', payload)

        success.value = true
        loading.value = false
        if (toast.value) {
            toast.value.showToast('Your message has been sent. Thank you!', 'success');
        } else {
            console.error('Toast component reference is not available');
        }
        // Reset form after success
        form.value = {
            name: '',
            email: '',
            phone: '',
            subject: '',
            message: '',
            uninstall_reason: '',
            type: form.value.type, // keep the type
            extension_id: form.value.extension_id,
            extension_version: form.value.extension_version,
        }

    } catch (error) {
        loading.value = false
        if (error.response?.status === 422) {
            errors.value = error.response.data.errors
        } else {
            errors.value = { general: 'Something went wrong. Please try again later.' }
        }

        if (toast.value) {
            toast.value.showToast('Something went wrong. Please try again later.', 'error');
        } else {
            console.error('Toast component reference is not available');
        }
    }
}
</script>

<template>
    <App>
        <Toast ref="toast" />
        <Preloader v-if="loading" />

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ pageTitle.heading }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">{{ pageTitle.heading }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Contact Section -->
        <section id="contact" class="contact section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ pageTitle.heading }}</h2>
                <p>{{ pageTitle.subheading }}</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <ContactInfo />
                <form @submit.prevent="submitForm" class="php-email-form" data-aos="fade-up" data-aos-delay="300">
                    <div class="row gy-4">

                        <div class="col-md-12">
                            <input v-model="form.name" type="text" class="form-control" placeholder="Your Name">
                            <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                        </div>

                        <div class="col-md-6">
                            <input v-model="form.email" type="email" class="form-control" placeholder="Your Email">
                            <div v-if="errors.email" class="text-danger">{{ errors.email[0] }}</div>
                        </div>
                        <div class="col-md-6">
                            <input v-model="form.phone" type="text" class="form-control"
                                placeholder="Your Phone Number">
                            <div v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</div>
                        </div>

                        <div class="col-md-12">
                            <input v-model="form.subject" type="text" class="form-control" placeholder="Subject">
                            <div v-if="errors.subject" class="text-danger">{{ errors.subject[0] }}</div>
                        </div>

                        <!-- If uninstall (goodbye), show reason dropdown -->
                        <div class="col-md-12" v-if="form.type === 'goodbye'">
                            <select v-model="form.uninstall_reason" class="form-control">
                                <option value="">Select a reason</option>
                                <option value="Not useful">Not useful</option>
                                <option value="Found a better alternative">Found a better alternative</option>
                                <option value="Performance issues">Performance issues</option>
                                <option value="Temporary uninstall">Temporary uninstall</option>
                                <option value="Other">Other</option>
                            </select>
                            <div v-if="errors.uninstall_reason" class="text-danger">{{ errors.uninstall_reason[0] }}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <!-- Change textarea label based on type -->
                            <textarea v-model="form.message" class="form-control" rows="6"
                                :placeholder="form.type === 'goodbye' ? 'Help us improve...' : 'Message'">
              </textarea>
                            <div v-if="errors.message" class="text-danger">{{ errors.message[0] }}</div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" :disabled="loading">Send Message</button>
                        </div>

                    </div>
                </form>

            </div>
        </section>


    </App>
</template>
