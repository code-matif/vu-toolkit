<template>
    <transition name="toast-animation">
        <div v-if="isVisible" class="toast-container" :class="positionClass">
            <div class="toast-message" :class="[toastType, { 'with-icon': showIcon }]">
                <div class="toast-content">
                    <div v-if="showIcon" class="toast-icon" :class="toastType">
                        <svg v-if="toastType === 'success'" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <svg v-else-if="toastType === 'error'" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                        <svg v-else-if="toastType === 'warning'" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                            </path>
                            <line x1="12" y1="9" x2="12" y2="13"></line>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <svg v-else-if="toastType === 'info'" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </div>
                    <div class="toast-text">{{ message }}</div>
                </div>
                <button type="button" @click.prevent="closeToast" class="toast-close" aria-label="Close notification">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';

const isVisible = ref(false);
const message = ref('');
const toastType = ref('success');
const position = ref('bottom-center'); // Default position set to bottom-center
const showIcon = ref(true);
const isMobile = ref(false);

const positionClass = computed(() => {
    // Auto-switch to top position on mobile
    if (isMobile.value) {
        if (position.value.includes('bottom')) {
            return 'bottom-center';
        }
        return 'top-center';
    }
    return position.value;
});

onMounted(() => {
    checkScreenSize();
    window.addEventListener('resize', checkScreenSize);
});

const checkScreenSize = () => {
    isMobile.value = window.innerWidth < 768;
};

const showToast = (msg, type = 'success', options = {}) => {
    message.value = msg;
    toastType.value = type;

    // Optional configuration
    if (options.position) position.value = options.position;
    if (options.showIcon !== undefined) showIcon.value = options.showIcon;

    isVisible.value = true;

    const duration = options.duration || 1000;
    setTimeout(() => {
        closeToast();
    }, duration);
};

const closeToast = () => {
    console.log('Toast closing'); // Debug log
    isVisible.value = false;
};

defineExpose({
    showToast,
});
</script>

<style>
/* Toast container positioning */
.toast-container {
    position: fixed;
    z-index: 99999;
    pointer-events: auto;
    max-width: 90vw;
}

/* Positions */
.toast-container.top-right {
    top: 20px;
    right: 20px;
}

.toast-container.top-left {
    top: 20px;
    left: 20px;
}

.toast-container.bottom-right {
    bottom: 20px;
    right: 20px;
}

.toast-container.bottom-left {
    bottom: 20px;
    left: 20px;
}

.toast-container.top-center {
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
}

.toast-container.bottom-center {
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

/* Toast message styling */
.toast-message {
    background-color: #333;
    color: white;
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 10px;
    min-width: 250px;
    max-width: 450px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
    line-height: 1.5;
    overflow: hidden;
    border-left: 4px solid transparent;
}

/* Toast with icon spacing */
.toast-message.with-icon .toast-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Toast content */
.toast-content {
    flex: 1;
    display: flex;
    align-items: center;
}

.toast-text {
    word-break: break-word;
}

/* Toast types */
.toast-message.success {
    background-color: #f0fdf4;
    color: #166534;
    border-color: #16a34a;
}

.toast-message.error {
    background-color: #fef2f2;
    color: #991b1b;
    border-color: #ef4444;
}

.toast-message.warning {
    background-color: #fffbeb;
    color: #92400e;
    border-color: #f59e0b;
}

.toast-message.info {
    background-color: #f0f9ff;
    color: #0c4a6e;
    border-color: #0ea5e9;
}

/* Toast icon colors */
.toast-icon.success {
    color: #16a34a;
}

.toast-icon.error {
    color: #ef4444;
}

.toast-icon.warning {
    color: #f59e0b;
}

.toast-icon.info {
    color: #0ea5e9;
}

/* Close button */
.toast-close {
    background: transparent;
    border: none;
    color: currentColor;
    opacity: 0.7;
    cursor: pointer;
    padding: 6px;
    margin-left: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    border-radius: 4px;
}

.toast-close:hover,
.toast-close:focus {
    opacity: 1;
    background-color: rgba(0, 0, 0, 0.1);
}

.toast-close:active {
    transform: scale(0.95);
}

/* Animations */
.toast-animation-enter-active {
    animation: slide-in 0.2s ease-out forwards;
}

.toast-animation-leave-active {
    animation: fade-out 0.2s ease-in forwards;
}

@keyframes slide-in {
    from {
        transform: translateY(20px);
        opacity: 0;
    }

    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fade-out {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
    }
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .toast-container {
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 40px);
    }

    .toast-message {
        min-width: unset;
        width: 100%;
    }

    .toast-container.top-center {
        top: 10px;
    }

    .toast-container.bottom-center {
        bottom: 10px;
    }
}
</style>
