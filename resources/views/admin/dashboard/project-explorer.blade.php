<x-admin>
    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Project Explorer
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400">
                Explore database tables, models, migrations, and routes.
            </p>
        </div>


        {{-- Database Tables --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">

            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">
                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Database Tables
                </h2>
            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">

                @foreach ($tables as $table)
                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition">

                        <div class="flex items-center justify-between">

                            <span class="font-medium text-gray-900 dark:text-white">
                                {{ $table->name }}
                            </span>


                            <span class="px-2 py-1 text-xs rounded-full bg-primary-100 text-primary-700">
                                Table
                            </span>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>



        {{-- Models --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">


            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">

                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Eloquent Models
                </h2>

            </div>


            <div class="p-6 flex flex-wrap gap-3">

                @foreach ($models as $model)
                    <span
                        class="px-3 py-2 rounded-lg text-sm bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200">

                        {{ $model }}

                    </span>
                @endforeach

            </div>


        </div>




        {{-- Migrations --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">


            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">

                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Migrations
                </h2>

            </div>


            <div class="divide-y divide-gray-200 dark:divide-gray-800">


                @foreach ($migrations as $migration)
                    <div class="px-6 py-3 text-sm text-gray-700 dark:text-gray-300">

                        {{ $migration }}

                    </div>
                @endforeach


            </div>


        </div>





        {{-- Routes --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800">


            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800">

                <h2 class="font-semibold text-gray-900 dark:text-white">
                    Routes
                </h2>

            </div>



            <div class="overflow-x-auto">

                <table class="w-full text-sm">


                    <thead class="bg-gray-50 dark:bg-gray-800">

                        <tr>

                            <th class="px-6 py-3 text-left">
                                Method
                            </th>

                            <th class="px-6 py-3 text-left">
                                URI
                            </th>

                            <th class="px-6 py-3 text-left">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left">
                                Controller
                            </th>

                        </tr>

                    </thead>



                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">


                        @foreach ($routes as $route)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">


                                <td class="px-6 py-3">

                                    <span class="px-2 py-1 text-xs rounded-md bg-success-100 text-success-700">

                                        {{ $route['method'] }}

                                    </span>

                                </td>


                                <td class="px-6 py-3 text-gray-900 dark:text-white">

                                    {{ $route['uri'] }}

                                </td>


                                <td class="px-6 py-3 text-gray-500">

                                    {{ $route['name'] ?? '-' }}

                                </td>


                                <td class="px-6 py-3 text-gray-500">

                                    {{ $route['action'] }}

                                </td>


                            </tr>
                        @endforeach


                    </tbody>


                </table>

            </div>


        </div>


    </div>
</x-admin>
