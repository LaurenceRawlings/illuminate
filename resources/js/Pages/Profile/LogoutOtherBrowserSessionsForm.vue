<template>
    <jet-action-section>
        <template #title>
            Browser Sessions
        </template>

        <template #description>
            Manage and logout your active sessions on other browsers and devices.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                If necessary, you may logout of all of your other browser sessions across all of your devices. Some of
                your recent sessions are listed below; however, this list may not be exhaustive. If you feel your
                account has been compromised, you should also update your password.
            </div>

            <!-- Other Browser Sessions -->
            <div v-if="sessions.length > 0" class="mt-5 space-y-6">
                <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
                    <div>
                        <svg v-if="session.agent.is_desktop" class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor"
                             stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>

                        <svg v-else class="w-8 h-8 text-gray-500" fill="none"
                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0h24v24H0z" stroke="none"></path>
                            <rect height="16" rx="1" width="10" x="7" y="4"></rect>
                            <path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="text-sm text-gray-600">
                            {{ session.agent.platform }} - {{ session.agent.browser }}
                        </div>

                        <div>
                            <div class="text-xs text-gray-500">
                                {{ session.ip_address }},

                                <span v-if="session.is_current_device"
                                      class="text-green-500 font-semibold">This device</span>
                                <span v-else>Last active {{ session.last_active }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <jet-button @click.native="confirmLogout">
                    Logout Other Browser Sessions
                </jet-button>

                <jet-action-message :on="form.recentlySuccessful" class="ml-3">
                    Done.
                </jet-action-message>
            </div>

            <!-- Logout Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingLogout" @close="confirmingLogout = false">
                <template #title>
                    Logout Other Browser Sessions
                </template>

                <template #content>
                    Please enter your password to confirm you would like to logout of your other browser sessions across
                    all of your devices.

                    <div class="mt-4">
                        <jet-input ref="password" v-model="form.password" class="mt-1 block w-3/4"
                                   placeholder="Password"
                                   type="password"
                                   @keyup.enter.native="logoutOtherBrowserSessions"/>

                        <jet-input-error :message="form.error('password')" class="mt-2"/>
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="confirmingLogout = false">
                        Nevermind
                    </jet-secondary-button>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                class="ml-2" @click.native="logoutOtherBrowserSessions">
                        Logout Other Browser Sessions
                    </jet-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    props: ['sessions'],

    components: {
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingLogout: false,

            form: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'logoutOtherBrowserSessions'
            })
        }
    },

    methods: {
        confirmLogout() {
            this.form.password = ''

            this.confirmingLogout = true

            setTimeout(() => {
                this.$refs.password.focus()
            }, 250)
        },

        logoutOtherBrowserSessions() {
            this.form.post(route('other-browser-sessions.destroy'), {
                preserveScroll: true
            }).then(response => {
                if (!this.form.hasErrors()) {
                    this.confirmingLogout = false
                }
            })
        },
    },
}
</script>
