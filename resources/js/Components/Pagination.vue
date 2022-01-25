<template>


    <div v-if="links.length > 3" class="flex  ">


        <div class="   m-auto">


             <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                <template v-for="(link, k) in links" :key="k">



                    <NavLink     :class="{ ' z-10 bg-indigo-200 hover:bg-indigo-400': link.active   }"   :href="link.url" v-html="link.label" as="button"   class="  bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">

                    </NavLink>


            </template>
            </nav>
        </div>

    </div>

</template>



<script>
import  NavLink from '@/Components/NavLink.vue'

export default {
    components: {

        NavLink,

    },
    props: {

        links: Array,

    },

}

</script>
