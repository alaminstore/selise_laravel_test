<template>
    <div class="container">
        <h4 class="text-muted">
            Dashboard : <b class="text-dark">{{ user.name }}</b>
        </h4>
        <createBook />
    </div>
</template>
<script type="text/javascript">
import createBook from "../components/CreateBook.vue";
import { mapGetters, mapActions } from "vuex";
export default {
    components: {
        createBook,
    },
    computed: {
        ...mapGetters({ user: "getUser" }),
    },
};
</script>
