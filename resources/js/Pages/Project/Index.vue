<template>
    <Head title="Dashboard - Projects"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard - Projects
            </h2>


        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <NavLink :href="route('dashboard.projects.create')">
                    <button type="button"
                            class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create New Task
                    </button>
                </NavLink>

                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg ">
                                <table class="min-w-full">
                                    <thead class="bg-blue-300 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Tasks
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Running
                                        </th>

                                        <th scope="col" class="relative py-3 px-6">
                                            <span class="sr-only">Show</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr v-for="project in projects.data"
                                        class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ project.name }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            <table class="min-w-full  justify-center ">
                                                <tr class="border-b    dark:border-gray-600">
                                                    <td>Count Characters</td>
                                                    <td class="float-right">
                                                        <template v-if=" project.task_characters_count < 5">
                                                            <b v-for="n in  (5 - project.task_characters_count)"
                                                               class="   bg-gray-300 rounded-full w-4 h-4 m-1 inline-flex"> </b>
                                                        </template>

                                                        <i v-for="(item,index) in project.task_characters " class="float-right">
                                                            <template v-if="index <  5">
                                                                <b class="  w-5 h-5  m-1 inline-flex animate-pulse"
                                                                   v-if="item.status =='pending' ">
                                                                    <img src="/img/hourglass-timer.png">
                                                                </b>
                                                                <b class="  w-5 h-5 m-1 inline-flex animate-spin-slow"
                                                                   v-else-if="item.status=='active'">
                                                                    <img src="/img/loading.png">
                                                                </b>
                                                                <b class="  bg-red-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='failed'"> </b>
                                                                <b class="  bg-green-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='success'"> </b>
                                                            </template>
                                                        </i>


                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="min-w-full justify-center">
                                                <tr class="border-b    dark:border-gray-600 justify-center">
                                                    <td>Count Lines</td>
                                                    <td class="float-right">
                                                        <template v-if=" project.task_lines_count < 5">
                                                            <b v-for="n in  (5 - project.task_lines_count)"
                                                               class="  bg-gray-300 rounded-full w-4 h-4 m-1 inline-flex"> </b>
                                                        </template>


                                                        <i v-for="(item,index)  in project.task_lines " class="float-right">
                                                            <template v-if="index <  5">
                                                                <b class="  w-5 h-5  m-1 inline-flex animate-pulse"
                                                                   v-if="item.status =='pending' ">
                                                                    <img src="/img/hourglass-timer.png">
                                                                </b>
                                                                <b class="  w-5 h-5 m-1 inline-flex animate-spin-slow"
                                                                   v-else-if="item.status=='active'">
                                                                    <img src="/img/loading.png">
                                                                </b>

                                                                <b class="  bg-red-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='failed'"> </b>
                                                                <b class="  bg-green-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='success'"> </b>
                                                            </template>
                                                        </i>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="min-w-full justify-center">
                                                <tr class=" justify-center">
                                                    <td>Count Words</td>
                                                    <td class="float-right">
                                                        <template v-if=" project.task_words_count < 5">
                                                            <b v-for="n in  (5 - project.task_words_count)"
                                                               class="  bg-gray-300 rounded-full w-4 h-4 m-1 inline-flex"> </b>
                                                        </template>
                                                        <i v-for="(item,index)  in project.task_words " class="float-right">
                                                            <template v-if="index <  5">
                                                                <b class="  w-5 h-5  m-1 inline-flex animate-pulse"
                                                                   v-if="item.status =='pending' ">
                                                                    <img src="/img/hourglass-timer.png">
                                                                </b>
                                                                <b class="  w-5 h-5 m-1 inline-flex animate-spin-slow"
                                                                   v-else-if="item.status=='active'">
                                                                    <img src="/img/loading.png">
                                                                </b>

                                                                <b class="  bg-red-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='failed'"> </b>
                                                                <b class="  bg-green-700 rounded-full w-4 h-4 m-1 inline-flex"
                                                                   v-else-if="item.status=='success'"> </b>
                                                            </template>
                                                        </i>


                                                    </td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ project.is_running }}
                                        </td>

                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <NavLink :href="route('dashboard.projects.show',project.uuid)"
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:underline">
                                                Show Project
                                            </NavLink>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <pagination class="mt-6" :links="projects.links"/>
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
import NavLink from '@/Components/NavLink.vue'
import Pagination from '@/Components/Pagination'

export default {
    components: {
        BreezeAuthenticatedLayout,
        NavLink,
        Head,
        Pagination,
    },
    props: {
        projects: Object,
    },
}
</script>
