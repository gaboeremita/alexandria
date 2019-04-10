<template>
    <div class="container">
        <ul class="pagination">
            <li style="vertical-align: sub">
                    {{pagination.from}} - {{pagination.to}} of {{pagination.total}}
            </li>
            <li>
                <a v-if="pagination.prevPageUrl" class="waves-effect active hoverable" @click="$emit('prev');">
                    Prev
                </a>
                <a class="disabled" v-else :disabled="true">
                    Prev
                </a>
            </li>
            <li>
                <a v-if="pagination.nextPageUrl" class="waves-effect active hoverable" @click="$emit('next');">
                    Next
                </a>
                <a class="disabled" v-else :disabled="true">
                    Next
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['pagination', 'filtered']
    }
</script>