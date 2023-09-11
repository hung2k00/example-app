@extends('main.header')
@section('content')
<div class="bg-gray-200 flex items-center justify-center full-login">
    <div class="max-w-md w-full space-y-8 bg-white p-5 rounded-3xl shadow-lg">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Cập nhật thông tin
            </h2>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('user_detail') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="name" class="">Name</label>
                    <input id="name" name="name" type="name" autocomplete="name" value="{{ $user->name }}"
                        readonly
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Name">
                </div>
                <div>
                    <label for="email" class="">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" value="{{ $user->email }}"
                        readonly
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Email">
                </div>
                <div>
                    <label for="password" class="">Password</label>
                    <input id="password" name="password" type="password" autocomplete="password" readonly
                        value="{{ $user->password }}"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="New Password">

                </div>
                <div>
                    <label for="gender" class="">Gender</label>
                    <select name="gender" id="gender"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                        <option value="Other">Other</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="birth_date" class="">Birth Date</label>
                    <input id="birth_date" name="birth_date" type="date" autocomplete="birth_date"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="New Password">
                        @error('birth_date')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="address" class="">Address</label>
                    <input id="address" name="address" type="text" autocomplete="address"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="Address">
                        @error('address')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cập nhật thông tin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
