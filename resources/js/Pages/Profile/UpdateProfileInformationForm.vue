<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input ref="photo" class="hidden"
                       type="file"
                       @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo"/>

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" alt="Current Profile Photo"
                         class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'"
                          class="block rounded-full w-20 h-20">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </jet-secondary-button>

                <jet-secondary-button v-if="user.profile_photo_path" class="mt-2" type="button"
                                      @click.native.prevent="deletePhoto">
                    Remove Photo
                </jet-secondary-button>

                <jet-input-error :message="form.error('photo')" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name"/>
                <jet-input id="name" v-model="form.name" autocomplete="name" class="mt-1 block w-full" type="text"/>
                <jet-input-error :message="form.error('name')" class="mt-2"/>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email"/>
                <jet-input id="email" v-model="form.email" class="mt-1 block w-full" type="email"/>
                <jet-input-error :message="form.error('email')" class="mt-2"/>
            </div>

            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="username" value="Username"/>
                <jet-input id="username" v-model="form.username" class="mt-1 block w-full" type="text"/>
                <jet-input-error :message="form.error('username')" class="mt-2"/>
            </div>

            <!-- Bio -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="bio" value="Bio"/>
                <jet-input id="bio" v-model="form.bio" class="mt-1 block w-full" type="text"/>
                <jet-input-error :message="form.error('bio')" class="mt-2"/>
            </div>

            <!-- Status Text -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="status_text" value="Status"/>
                <div class="flex items-center">
                    <jet-input id="status_emoji" v-model="form.status_emoji" class="mt-1 block w-15 text-center mr-2"
                               disabled type="text"/>
                    <jet-input id="status_text" v-model="form.status_text" class="mt-1 block w-full" type="text"/>
                    <div class="absolute ml-4">
                        <emoji-picker :data="data" @emoji:picked="selectEmoji"/>
                    </div>
                </div>
                <jet-input-error :message="form.error('status_text')" class="mt-2"/>
                <jet-input-error :message="form.error('status_emoji')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

import data from '@zaichaopan/emoji-picker/data/emojis.json';

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
    },

    props: {
        user: Object,
        bio: String,
        status_text: String,
        status_emoji: String
    },

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'PUT',
                name: this.user.name,
                email: this.user.email,
                username: this.user.username,
                photo: null,
                bio: this.bio,
                status_text: this.status_text,
                status_emoji: this.status_emoji,
            }, {
                bag: 'updateProfileInformation',
                resetOnSuccess: false,
            }),

            photoPreview: null,

            data: data,
        }
    },

    methods: {
        selectEmoji(emoji) {
            this.form.status_emoji = emoji;
        },
        updateProfileInformation() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0]
            }

            this.form.post(route('user-profile-information.update'), {
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deletePhoto() {
            this.$inertia.delete(route('current-user-photo.destroy'), {
                preserveScroll: true,
            }).then(() => {
                this.photoPreview = null
            });
        },
    },
}
</script>

<style>
.emoji-invoker {
    @apply opacity-0;
}
</style>
