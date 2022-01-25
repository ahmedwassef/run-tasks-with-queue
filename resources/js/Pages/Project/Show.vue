<template>
    <Head title=" Project "/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="bg-green-0 bg-red-0 font-semibold text-xl text-gray-800 leading-tight">
                Project {{project.name}} Tasks
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg ">
                                <table class="min-w-full">
                                    <thead class="bg-blue-300  dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Type
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            #occerrnnces
                                        </th>

                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Results
                                        </th>

                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Created At
                                        </th>
                                         <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Start At
                                        </th>

                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            End At
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <tr v-for="task in tasks.data" v-bind:class="task.status_class"    >
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ task.uuid.substring(0,20)+"...." }}
                                        </td>
                                         <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                           Count {{ task.type }}s
                                        </td>

                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400  "   >
                                            {{ task.count }}
                                            <sup v-if="task.status=='active'">*</sup>
                                        </td>

                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <div v-if="task.status=='active'" class="w-full bg-gray-300 rounded-full dark:bg-gray-700">
                                                <div class="bg-blue-600 text-xs font-medium text-white text-center p-0.5 leading-none rounded-full" :style="'width:'+task.progress+'%'">
                                                    {{task.progress}}%</div>
                                            </div>

                                            <div  v-else-if="task.status=='pending'" class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 animate-pulse">
                                                <div class="bg-gray-0 h-2.5 rounded-full dark:bg-gray-300" style="width: 0%"></div>
                                            </div>


                                            <b v-else-if="task.status=='failed'"  class="w-full  ">
                                                   Fail
                                            </b>
                                            <b v-else-if="task.status=='success'"  class="w-full  ">
                                                   Pass
                                            </b>
                                        </td>


                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ task.created_at }}
                                        </td>

                                        <td class="py-3 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ task.started_at??'-' }}
                                        </td>

                                        <td class="py-3 px-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ task.finished_at??'-' }}
                                         </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <pagination class="mt-6" :links="tasks.links"/>
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
import {useForm} from '@inertiajs/inertia-vue3'
import Pagination from '@/Components/Pagination'

export default {
    props: {
        errors: Object,
        project: Object,
        tasks: Object,
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Pagination,
    },
    setup() {
        const form = useForm({
            name: null,
            task_type: null,
            file: null,
        })

        function submit() {
            form.post('/dashboard/projects')
        }


        return {form, submit}
    },
}
</script>
