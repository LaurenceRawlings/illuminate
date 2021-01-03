<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    scope="col">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    scope="col">
                                    Username
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    scope="col">
                                    Member Since
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    scope="col">
                                    Role
                                </th>
                                <th class="relative px-6 py-3" scope="col">
                                    <span class="sr-only">Delete</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users.data" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <profile-photo :user="user"/>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 font-bold">
                                                <profile-link :user="user"/>
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ user.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">
                                        {{ user.username }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ user.member_since }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span :class="user.is_admin ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'"
                                              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                            {{ user.is_admin ? 'Admin' : 'User' }}
                                        </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button class="text-red-500 hover:text-red-900 hover:underline"
                                            @click="confirmUserDeletion(user)">Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <jet-dialog-modal :show="confirmingUserDeletion" @close="confirmingUserDeletion = false">
                    <template #title>
                        Delete User
                    </template>

                    <template #content>
                        Are you sure you want to delete this user? Once the account is deleted, it will be permanently
                        deleted.
                    </template>

                    <template #footer>
                        <jet-secondary-button @click.native="confirmingUserDeletion = false">
                            Nevermind
                        </jet-secondary-button>

                        <jet-danger-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                           class="ml-2" @click.native="deleteUser">
                            Delete User
                        </jet-danger-button>
                    </template>
                </jet-dialog-modal>

                <pagination-links
                    :next_page_url="users.next_page_url"
                    :previous_page_url="users.prev_page_url"
                    :urls_array="paginated_links">
                </pagination-links>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Shared/Layouts/AppLayout";
import PaginationLinks from "@/Shared/Components/PaginationLinks";
import ProfilePhoto from "@/Shared/Components/ProfilePhoto";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";
import ProfileLink from "@/Shared/Components/ProfileLink";

export default {
    components: {
        ProfileLink,
        ProfilePhoto,
        PaginationLinks,
        AppLayout,
        JetDialogModal,
        JetSecondaryButton,
        JetDangerButton
    },
    props: {
        users: Object,
        paginated_links: Array,
    },
    data() {
        return {
            confirmingUserDeletion: false,

            user: null,

            form: this.$inertia.form({
                '_method': 'DELETE',
            }, {
                bag: 'deleteUser'
            }),
        }
    },
    methods: {
        confirmUserDeletion(user) {
            this.confirmingUserDeletion = true;
            this.user = user;
        },
        deleteUser() {
            this.confirmingUserDeletion = false;
            this.form.post(route('users.destroy', this.user.id), {
                preserveScroll: true
            })
        }
    },
}
</script>

<style scoped>

</style>
