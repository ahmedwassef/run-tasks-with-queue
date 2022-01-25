<template>
    <Head title="Create Task"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Task
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="bg-white bg-gradient-to-r bg-white  inline-block py-5 min-w-full sm:px-6 lg:px-8">
                            <form @submit.prevent="submit">
                                <div class="mb-6">
                                    <label for="name"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Project
                                        Name</label>
                                    <div class="flex">
                                  <span
                                      class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 rounded-l-md border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    PRJ_
                                  </span>
                                        <input type="text" id="name"
                                               maxlength="6"
                                                v-model="form.name"
                                               class="rounded-none rounded-r-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                               placeholder=" ">
                                    </div>
                                    <div  v-if="errors.name"  class="mt-1 text-sm text-red-900 dark:text-gray-300" id="errors_file">
                                        {{ errors.name }}
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="task_type"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Project
                                        Task Type</label>
                                    <fieldset>
                                        <legend class="sr-only">Task Type</legend>

                                        <div class="flex items-center mb-4">
                                            <input id="count-words" type="radio" name="countries" value="Word"
                                                   class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="form.task_type"
                                                   aria-labelledby="count-words"
                                                   aria-describedby="count-words"  >
                                            <label for="count-words"
                                                   class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                  Count Words
                                            </label>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <input id="count-Lines" type="radio" name="countries" value="Line"
                                                   class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="form.task_type"
                                                   aria-labelledby="count-Lines"
                                                   aria-describedby="count-Lines"  >
                                            <label for="count-Lines"
                                                   class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                Count Lines
                                            </label>
                                        </div>
                                        <div class="flex items-center mb-4">
                                            <input id="count-characters" type="radio" name="countries" value="Character"
                                                   class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                                   v-model="form.task_type"
                                                   aria-labelledby="count-characters"
                                                   aria-describedby="count-characters"  >
                                            <label for="count-characters"
                                                   class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                Count Characters
                                            </label>
                                        </div>

                                    </fieldset>
                                    <div  v-if="errors.task_type"  class="mt-1 text-sm text-red-900 dark:text-gray-300" id="errors_file">
                                        {{ errors.task_type }}
                                    </div>
                                </div>
                                <div class="mb-6">

                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                           for="file_uploader">Upload file
                                    </label>
                                    <input
                                        @input="form.file = $event.target.files[0]"
                                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                        id="file_uploader" type="file">
                                    

                                    <div  v-if="errors.file"  class="mt-1 text-sm text-red-900 dark:text-gray-300" id="errors_file">
                                        {{ errors.file }}
                                    </div>

                                </div>

                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 float-right">
                                   Create
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    props: {
        errors: Object,
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    setup () {
        const form = useForm({
            name: null,
            task_type: null,
            file: null,
        })

        function submit() {
            form.post('/dashboard/projects')
        }


        return { form, submit }
    },
}
</script>
