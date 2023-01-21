<template>
    <div class="pt-1 container">
        <div class="pt-1 text-center">
            <h1 class="text-muted">Book List</h1>
        </div>
        <div
            class="book_list d-flex justify-content-start align-items-center gap-3"
        >
            <div
                class="card"
                v-for="(book, index) in books"
                :key="index"
                style="width: 18rem"
            >
                <div class="card-body">
                    <h5 class="card-title">{{ book.name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ }}</h6>
                    <p class="card-text">
                        Some quick example text to build on the card title and
                        make up the bulk of the card's content.
                    </p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Home",
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
};
</script>
