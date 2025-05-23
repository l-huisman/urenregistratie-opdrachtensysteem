<x-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto"
                 src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <x-forms.form method="POST" action="/login">
                <x-forms.input name="email" label="Email address" type="email" required autofocus
                               autocomplete="email"/>
                <x-forms.input name="password" label="Password" type="password" required
                               autocomplete="current-password"/>
                <x-forms.button>Sign in</x-forms.button>
            </x-forms.form>
        </div>
    </div>
</x-layout>
