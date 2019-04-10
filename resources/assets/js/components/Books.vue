<template>
    <div class="books">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">search</i>
                <input class="input" type="text" v-model="tableData.search" placeholder="Search by title"
                       @input="getBooks()">
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="book in books" :key="book.id">
                    <td>
                        <a :href="`/books/${book.slug}`">
                            {{ book.title }}
                        </a>
                    </td>
                    <td>{{ book.description }}</td>
                    <td>{{ book.author }}</td>
                    <td>{{ book.published }}</td>
                    <td>{{ book.category }}</td>
                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getBooks(pagination.prevPageUrl)"
                    @next="getBooks(pagination.nextPageUrl)">
        </pagination>
    </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.getBooks();
    },
    data() {
        let sortOrders = {};

        let columns = [
            { width: '25%', label: 'title', name: 'title' },
            { width: '30%', label: 'description', name: 'description' },
            { width: '15%', label: 'author', name: 'author' },
            { width: '15%', label: 'published', name: 'published' },
            { width: '15%', label: 'category', name: 'category' },
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            books: [],
            columns: columns,
            sortKey: 'title',
            sortOrders: sortOrders,
            perPage: 10,
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },
        }
    },
    methods: {
        getBooks(url = '/books/bookfeeder') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.books = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getBooks();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>
