<x-layout title="Employee Management">

    {{--  Table  --}}
    <form class="flex gap-3 mb-4 w-full" method="GET" action="{{ route("employees.home") }}">
        <div class="flex gap-3 mb-4 w-full">
            <a href="{{ route("employees.create") }}"
               class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 rounded-xl bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Add New
            </a>
            <div class="max-w-xs w-full">
                <input type="text" placeholder="Search..." name="query" value="{{ $query }}"
                       class="flex w-full h-10 px-3 py-2 text-sm bg-white border rounded-xl border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50"/>
            </div>
            <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-xl text-neutral-800 hover:text-neutral-700 border-neutral-200/70 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                </svg>
            </button>
        </div>
        <div class="flex justify-end gap-4 mb-4 w-full">
            <x-select class="w-full max-w-40" name="post">
                <option value="">Choose Position</option>
                @foreach($positions as $position)
                    <option
                        value="{{ $position->value }}" @selected($post == $position->value) >{{ $position->name }}</option>
                @endforeach
            </x-select>
            <button type="submit"
                    class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-200 bg-white border rounded-xl text-neutral-800 hover:text-neutral-700 border-neutral-200/70 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60 focus:shadow-outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/>
                </svg>
            </button>
        </div>
    </form>
    <div class="flex flex-col border rounded-xl bg-white">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-neutral-200">
                        <thead>
                        <tr class="text-neutral-800 uppercase">
                            <th class="px-5 py-3 text-sm font-medium text-left">No</th>
                            <th class="px-5 py-3 text-sm font-medium text-left">NIK</th>
                            <th class="px-5 py-3 text-sm font-medium text-left">Nama Lengkap</th>
                            <th class="px-5 py-3 text-sm font-medium text-left">Nomor Telepon</th>
                            <th class="px-5 py-3 text-sm font-medium text-left">Posisi</th>
                            <th class="px-5 py-3 text-sm font-medium text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                        @foreach($employees as $i => $employee)
                            <tr class="text-neutral-800">
                                <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{ ($employee->perPage*$employee->currentPage) + $i+1 }}
                                    .
                                </td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $employee->id_number }}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{ "$employee->first_name $employee->last_name" }}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{ $employee->phone_number }}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{ ucfirst($employee->position) }}</td>
                                <td class="px-5 py-4 flex justify-center gap-3 text-sm font-medium text-right whitespace-nowrap">
                                    <a class="text-blue-600 hover:text-blue-700"
                                       href="{{ route("employees.edit", ["employee" => $employee->id]) }}">Edit</a>
                                    <a class="text-red-600 hover:text-blue-700"
                                       onclick="return confirm('Are you sure you want to delete this employee?')"
                                       href="{{ route("employees.destroy", ["employee" => $employee->id]) }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="my-6">
        {{ $employees->links() }}
    </div>
</x-layout>


