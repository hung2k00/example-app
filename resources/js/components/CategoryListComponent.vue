<template>
    <div class="all_create flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-full relative">
                <div
                    @click="handleCreate()"
                    class="absolute -top-1 right-0 cursor-pointer bg-slate-400 rounded-xl p-2"
                >
                    <p class="text-red-500">Create Category</p>
                </div>
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Category List
                </h1>
                <div class="table-list pt-4 mt-10">
                    <table class="w-full -mt-4 table-auto">
                        <thead>
                            <tr class="text-center z-10">
                                <th>Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="category in categories"
                                :key="category.id"
                                class="text-center mt-2 text-red-600"
                            >
                                <td>{{ category.name }}</td>
                                <td>{{ category.code }}</td>
                                <td>{{ category.description }}</td>
                                <td>
                                    <button @click="handleDelete(category.id)">
                                        Delete
                                    </button>
                                    <button
                                        @click="handleEdit(category.id)"
                                        class="ml-4"
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
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";
export default {
    data() {
        return {
            categories: [],
        };
    },
    created() {
        this.fetchUsers();
    },
    methods: {
        fetchUsers() {
            axios
                .get("/api/category")
                .then((response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async handleDelete(itemId) {
            try {
                await axios.delete(`/api/category/${itemId}`);
                Toastify({
                    text: "Delete category successfully!",
                    duration: 3000,
                    gravity: "top",
                    backgroundColor: "green",
                    stopOnFocus: true,
                }).showToast();
                this.fetchUsers();
            } catch (error) {
                console.error(error);
                Toastify({
                    text: "Fail delete category successfully!",
                    duration: 3000,
                    gravity: "top",
                    backgroundColor: "red",
                    stopOnFocus: true,
                }).showToast();
            }
        },
        handleEdit(itemId) {
            window.location.href = `/category/edit/${itemId}`;
        },
        handleCreate() {
            window.location.href = `/category/create`;
        },
    },
};
</script>

