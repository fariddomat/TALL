<x-app-layout>
    <div class="container mx-auto p-6">
        <livewire:user-form :isEdit="true" :userId="$user->id" />
    </div>
</x-app-layout>
