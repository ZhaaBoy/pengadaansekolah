{{-- resources/views/users/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Buat Akun</h2>
    </x-slot>
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('users.store') }}" class="bg-white p-6 shadow sm:rounded-lg space-y-4">
            @csrf
            <x-input-label value="Nama" /><x-text-input name="name" class="w-full" required />
            <x-input-label value="Email" /><x-text-input type="email" name="email" class="w-full" required />
            <x-input-label value="Role" />
            <select name="role" class="w-full border rounded p-2" required>
                <option value="staff">Staff</option>
                <option value="vendor">Vendor</option>
                <option value="kepala_sekolah">Kepala Sekolah</option>
            </select>
            <x-input-label value="Password" /><x-text-input type="password" name="password" class="w-full" required />
            <x-input-label value="Konfirmasi Password" /><x-text-input type="password" name="password_confirmation"
                class="w-full" required />
            <x-primary-button>Buat</x-primary-button>
        </form>
    </div>
</x-app-layout>
