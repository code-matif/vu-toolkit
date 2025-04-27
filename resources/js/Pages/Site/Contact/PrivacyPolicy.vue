<script setup>
import App from '@/Layouts/Site/App.vue'
import ContactInfo from '@/Components/Site/ContactInfo.vue'
</script>

<template>
    <App>

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Privacy Policy</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Privacy Policy</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Privacy Policy Section -->
        <section id="privacy-policy" class="contact section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Privacy Policy</h2>
                <p>Enhanced privacy: No personal data collected or shared.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="content">

                    <h3>Data Collection</h3>
                    <p>VU Toolkit does not collect, store, or transmit any personal identifiable information (PII), financial data, health information, or user communications. All extension functionalities work locally on your device without sending your data to external servers.</p>

                    <h3>Permissions and Justifications</h3>
                    <div class="permissions-table">
                        <div class="permission-item">
                            <div class="permission-name"><strong>activeTab</strong></div>
                            <div class="permission-desc">Needed to interact with the current LMS page and apply modifications like enabling copy-paste, auto-marking lectures.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>contextMenus</strong></div>
                            <div class="permission-desc">Used to add quick actions (e.g., saving quiz questions, accessing ChatGPT) directly from right-click menu.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>declarativeNetRequestWithHostAccess</strong></div>
                            <div class="permission-desc">Used to modify certain network requests for enhancing user experience, like skipping video tracking.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>host permissions</strong> (https://vulms.vu.edu.pk/*)</div>
                            <div class="permission-desc">Needed to run the extension only on VULMS website pages. We do not collect any personal data.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>remote code</strong></div>
                            <div class="permission-desc">We do not use remote code in production.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>scripting</strong></div>
                            <div class="permission-desc">Needed to inject scripts into VULMS pages to enable features like copy-paste and dark mode.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>storage</strong></div>
                            <div class="permission-desc">Used to store user preferences locally and save quizzes or progress inside the browser only.</div>
                        </div>

                        <div class="permission-item">
                            <div class="permission-name"><strong>tabs</strong></div>
                            <div class="permission-desc">Used to interact with browser tabs to properly inject scripts and read tab URL to ensure it's a VULMS page.</div>
                        </div>
                    </div>

                    <h3>Third-party Services</h3>
                    <p>This extension does not use third-party tracking or analytics services. No information is shared with external parties.</p>

                    <h3>Contact Us</h3>
                    <p>If you have any questions regarding this Privacy Policy, feel free to contact us.</p>

                </div>
                <ContactInfo />
            </div>
        </section>

    </App>
</template>

<style scoped>
.permissions-table {
    margin: 1.5rem 0;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
}

.permission-item {
    display: flex;
    padding: 1rem;
    border-bottom: 1px solid #eee;
}

.permission-item:last-child {
    border-bottom: none;
}

.permission-item:nth-child(odd) {
    background-color: #f9f9f9;
}

.permission-name {
    flex: 0 0 30%;
    padding-right: 1rem;
    font-weight: 500;
}

.permission-desc {
    flex: 0 0 70%;
}

@media (max-width: 768px) {
    .permission-item {
        flex-direction: column;
    }

    .permission-name {
        margin-bottom: 0.5rem;
    }
}
</style>
