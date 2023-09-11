<template>
    <div class="all_create h-screen flex justify-center items-center">
        <div
            class="bg-white w-2/3 flex justify-center items-center p-6 rounded-3xl shadow-lg shadow-orange-900"
        >
            <div class="w-full">
                <div class="flex gap-10 px-6 mx-auto">
                    <div
                        @click="handleCreate()"
                        class="cursor-pointer bg-slate-400 rounded-xl p-2"
                    >
                        <p class="text-red-500">Create Hotel</p>
                    </div>
                    <h1 class="text-red-300 text-3xl font-bold text-center">
                        Hotel List
                    </h1>
                    <div class="w-1/3 ml-4">
                        <select
                            v-model="selectedCategory"
                            class="cursor-pointer block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        >
                            <option value="">All Categories</option>
                            <option
                                v-for="category in categories"
                                :value="category.id"
                                :key="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div
                        @click="handleExport()"
                        class="cursor-pointer bg-slate-400 rounded-xl p-2"
                    >
                        <p class="text-red-500">Export Excel File</p>
                    </div>
                    <div
                        @click="handleImport()"
                        class="cursor-pointer bg-slate-400 rounded-xl p-2"
                    >
                        <p class="text-red-500">Import Excel File</p>
                    </div>
                </div>

                <div class="table-list pt-4 mt-10">
                    <table class="w-full -mt-4 table-auto">
                        <thead>
                            <tr class="text-center z-10">
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Price Max</th>
                                <th>Price Min</th>
                                <th>Category</th>
                                <th>Sale Day</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="hotel in filteredHotels"
                                :key="hotel.id"
                                class="text-center mt-2 text-red-600"
                            >
                                <td>
                                    <img
                                        :src="'/images/' + hotel.image"
                                        alt=""
                                        class="h-10 w-10"
                                    />
                                </td>
                                <td>{{ hotel.name }}</td>
                                <td>{{ hotel.code }}</td>
                                <td>{{ hotel.price_max }}</td>
                                <td>{{ hotel.price_min }}</td>
                                <td>{{ hotel.category.name }}</td>
                                <td>{{ hotel.sale_day }}</td>
                                <td>
                                    <button @click="handleDelete(hotel.id)">
                                        Delete
                                    </button>
                                    <button
                                        @click="handleEditHotel(hotel.id)"
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
            hotels: [],
            categories: [],
            selectedCategory: "",
        };
    },
    created() {
        this.fetchHotels();
        this.fetchCategories();
    },
    methods: {
        fetchCategories() {
            axios
                .get("/api/category")
                .then((response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchHotels() {
            axios
                .get("/api/hotel")
                .then((response) => {
                    this.hotels = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async handleDelete(itemId) {
            try {
                await axios.delete(`/api/hotel/${itemId}`);
                Toastify({
                    text: "Delete category successfully!",
                    duration: 3000,
                    gravity: "top",
                    backgroundColor: "green",
                    stopOnFocus: true,
                }).showToast();
                this.fetchHotels();
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
        handleCreate() {
            window.location.href = `/hotel/create`;
        },
        handleEditHotel(itemId) {
            window.location.href = `/hotel/edit/${itemId}`;
        },
        handleExport() {
            if (this.selectedCategory) {
                window.location.href = `/hotel/export-hotels/${this.selectedCategory}`;
            } else {
                window.location.href = `/hotel/export`;
            }
        },
        handleImport() {
            window.location.href = `/hotel/excel-csv-file`;
        }
    },
    computed: {
        filteredHotels() {
            if (!this.selectedCategory) {
                return this.hotels;
            }
            return this.hotels.filter(
                (hotel) => hotel.category.id === this.selectedCategory
            );
        },
    },
};
</script>

