<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-1/2 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-2/3">
                <h1 class="text-red-300 text-3xl font-bold text-center">
                    Category Create
                </h1>
                <form @submit.prevent="handleSubmit">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" v-model="category.name" />
                        <p v-if="errors.name" class="text-red-500">
                            {{ errors.name[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="name">Code:</label>
                        <input type="text" id="name" v-model="category.code" />
                        <p v-if="errors.code" class="text-red-500">
                            {{ errors.code[0] }}
                        </p>
                    </div>
                    <div>
                        <label for="name">Description:</label>
                        <input
                            type="text"
                            id="name"
                            v-model="category.description"
                        />
                        <p v-if="errors.description" class="text-red-500">
                            {{ errors.description[0] }}
                        </p>
                    </div>
                    <!-- Thêm các trường dữ liệu khác của mục ở đây (nếu cần) -->
                    <div class="flex justify-center items-center mt-8 gap-4">
                        <button type="submit">Submit</button>
                        <button type="submit" @click="handleClose()">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Toastify from "toastify-js";

export default {
    props: {
        creates: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            category: {
                name: "",
                code: "",
                description: "",
            },
            errors: {},
        };
    },
    methods: {
        handleSubmit() {
            axios
                .post("/api/category/create", this.category)
                .then((response) => {
                    Toastify({
                        text: "Add category successfully!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    this.category = response.data;
                    console.log(response.data);
                    this.category.name = "";
                    this.category.code = "";
                    this.category.description = "";
                    window.location.href = `/category`;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                        Toastify({
                            text: "Failed add category successfully!",
                            duration: 3000,
                            gravity: "top",
                            backgroundColor: "red",
                            stopOnFocus: true,
                        }).showToast();
                    }
                });
        },
        handleClose() {
            window.location.href = `/category`;
        },
    },
};
</script>

