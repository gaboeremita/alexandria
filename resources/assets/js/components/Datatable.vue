<template>
    <table class="striped highlight">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    {{column.label}}<i class="material-icons tiny">sort</i>
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>