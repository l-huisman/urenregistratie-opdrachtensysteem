<nav class="flex flex-col p-4 bg-indigo-600 h-full">

    <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-4">
        <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=white"
             alt="Your Company"/>
    </div>

    <x-navigation.divider/>

    <ul class="flex-grow">
        <x-navigation.link icon="home" route="dashboard">Dashboard</x-navigation.link>
        <x-navigation.link icon="users" route="">Team</x-navigation.link>
        <x-navigation.link icon="currency-euro" route="">Budget</x-navigation.link>
        <x-navigation.link icon="users" route="">Gebruikers</x-navigation.link>
        <x-navigation.link icon="user-group" route="">Klanten</x-navigation.link>
        <x-navigation.link icon="cog" route="">Instellingen</x-navigation.link>
    </ul>

    <x-navigation.divider/>

    <x-navigation.account-link icon="user">Account</x-navigation.account-link>

</nav>
