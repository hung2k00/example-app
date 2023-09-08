<template>
    <div class="bg-gray-200 flex items-center justify-center full-login">
        <div class="bg-white p-8 rounded-3xl shadow-md w-96">
            <h1 class="text-2xl font-semibold mb-4">Đăng Nhập</h1>
            <form @submit.prevent="login">
                <div class="mb-4">
                    <label
                        class="block text-gray-600 text-sm font-medium mb-2"
                        for="email"
                        >Email</label
                    >
                    <input
                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500"
                        type="email"
                        id="email"
                        name="email"
                        v-model="account.email"
                    />
                    <p v-if="errors.email" class="text-red-500">
                        {{ errors.email[0] }}
                    </p>
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-600 text-sm font-medium mb-2"
                        for="password"
                        >Mật Khẩu</label
                    >
                    <div class="relative">
                        <input
                            class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-indigo-500"
                            type="password"
                            id="password"
                            name="password"
                            v-model="account.password"
                        />
                        <i
                            class="hidden"
                            :class="{
                                'fa-eye': showPassword,
                                'fa-eye-slash': !showPassword,
                            }"
                            @click="togglePasswordVisibility"
                        ></i>
                        <p v-if="errors.password" class="text-red-500">
                            {{ errors.password[0] }}
                        </p>
                    </div>
                </div>
                <div class="mb-4">
                    <label
                        class="block text-gray-600 text-sm font-medium mb-2"
                        for="remember"
                    >
                        <input
                            type="checkbox"
                            class="form-checkbox h-5 w-5"
                            id="remember"
                            v-model="account.remember"
                        />
                        Ghi nhớ thông tin đăng nhập
                    </label>
                </div>
                <button
                    class="w-full bg-indigo-500 text-white py-2 rounded-lg hover:bg-indigo-600 transition duration-300"
                    type="submit"
                >
                    Đăng Nhập
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import Toastify from "toastify-js";
export default {
    data() {
        return {
            showPassword: false,
            account: {
                email: "",
                password: "",
                remember: "",
            },
            errors: {},
        };
    },
    methods: {
        togglePasswordVisibility() {
            this.showPassword = !this.showPassword;
        },
        login() {
            // Sử dụng axios hoặc Fetch API để gửi yêu cầu đăng nhập đến API Laravel
            axios
                .post("/api/login", {
                    email: this.account.email,
                    password: this.account.password,
                    remember: this.account.remember,
                })
                .then((response) => {
                    const token = response.data.token;

                    localStorage.setItem("token", token);

                    axios.defaults.headers.common["Authorization"] =
                        "Bearer " + token;
                    Toastify({
                        text: "Đăng nhập thành công!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "green",
                        stopOnFocus: true,
                    }).showToast();
                    window.location.href = `/`;
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    Toastify({
                        text: "Đăng nhập thất bại!",
                        duration: 3000,
                        gravity: "top",
                        backgroundColor: "red",
                        stopOnFocus: true,
                    }).showToast();
                });
        },
    },
};
</script>
