<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create New Book</div>

                    <div class="card-body">
                        <div class="input-group">
                            <input
                                type="text"
                                placeholder="Todo.."
                                class="form-control"
                                aria-label="todo"
                                aria-describedby="todo"
                                v-model="todo_input"
                            />
                            <div class="input-group-append">
                                <button
                                    v-if="!edit_todo_id"
                                    type="button"
                                    class="btn btn-info text-white"
                                    @click="saveTodo()"
                                >
                                    Add
                                </button>

                                <button
                                    v-else
                                    type="button"
                                    class="btn btn-info text-white"
                                    @click="updateTodo()"
                                >
                                    Update
                                </button>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="btn btn-sm text-danger float-right"
                            @click="resetTodo()"
                        >
                            Reset
                        </button>

                        <table class="table table-bordered mt-4">
                            <thead>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr v-for="(todo, index) in books" :key="index">
                                    <td>{{ ++index }}</td>
                                    <td>{{ todo.name }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            @click="deleteTodo(--index)"
                                        >
                                            Delete
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-info"
                                            @click="editTodo(--index)"
                                        >
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: [],
            api: "http://localhost:8000/api/books",
            todo_input: "",
            edit_todo_id: "",
            edit_index: "",
        };
    },
    mounted() {
        // get api data
        this.axios.get(this.api).then((res) => {
            this.books = res.data;
        });
    },
    methods: {
        saveTodo() {
            if (this.todo_input.length > 0) {
                let data = { name: this.todo_input };
                this.axios.post(this.api, data).then((res) => {
                    this.books.push(res.data);
                    this.todo_input = "";
                });
            }
        },
        deleteTodo(index) {
            if (this.books[index].id) {
                this.axios
                    .delete(this.api + "/" + this.books[index].id)
                    .then((res) => {
                        this.books.splice(index, 1);
                    });
            }
        },
        editTodo(index) {
            if (this.books[index].id) {
                this.todo_input = this.books[index].name;
                this.edit_todo_id = this.books[index].id;
                this.edit_index = index;
            }
        },
        updateTodo() {
            if (this.todo_input.length > 0) {
                let data = { name: this.todo_input };
                this.axios
                    .patch(
                        this.api + "/" + this.books[this.edit_index].id,
                        data
                    )
                    .then((res) => {
                        this.books[this.edit_index].name = res.data.name;
                        this.resetTodo();
                    });
            }
        },
        resetTodo() {
            this.todo_input = "";
            this.edit_index = "";
            this.edit_todo_id = "";
        },
    },
};
</script>
