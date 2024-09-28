<x-layout :title="$title">
    <form class="flex flex-col gap-6" action="{{route("employees.$method", $param ?? [])}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <x-input label="First Name" name="first_name" value="{{ isset($employee) ? $employee->first_name : '' }}"
                     required/>

            <x-input label="Last Name" name="last_name" value="{{ isset($employee) ? $employee->last_name : '' }}"
                     required/>
        </div>

        <x-input label="No. KTP" name="id_number" value="{{ isset($employee) ? $employee->id_number : '' }}" required/>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <x-select label="Position" name="position" value="{{ isset($employee) ? $employee->position : '' }}">
                <option value="">Choose Position</option>
                @foreach($positions as $position)
                    <option value="{{$position->value}}">{{$position->name}}</option>
                @endforeach
            </x-select>

            <x-select label="Bank Account" name="bank_account"
                      value="{{ isset($employee) ? $employee->bank_account : '' }}">
                <option value="">Choose Bank Account</option>
                @foreach($banks as $bank)

                    <option value="{{$bank->value}}">{{$bank->name}}</option>
                @endforeach
            </x-select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-input label="Phone Number" name="phone_number"
                     value="{{ isset($employee) ? $employee->phone_number : '' }}" required/>

            <x-input label="Email" type="email" name="email" value="{{ isset($employee) ? $employee->email : '' }}"/>

            <x-input label="Birth Date" type="date" name="birth_date"
                     value="{{ isset($employee) ? $employee->birth_date : '' }}"/>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <x-select label="Province" id="province" name="province"
                      value="{{ isset($employee) ? $employee->province : '' }}">
                <option value="">Select a province</option>
            </x-select>
            <x-select label="City" id="city" name="city" value="{{ isset($employee) ? $employee->city : '' }}">
                <option value="">Select a city</option>
            </x-select>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <x-input label="Street" name="street" value="{{ isset($employee) ? $employee->street : '' }}"/>
            <x-input label="Zip Code" name="zip_code" value="{{ isset($employee) ? $employee->zip_code : '' }}"/>
        </div>
        <x-upload label="Scan KTP" name="id_scan" preview
                  :currentFile="isset($employee) ? $employee->id_scan : null"/>
        <div>
            <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 font-medium tracking-wide text-white transition-colors duration-200 rounded-xl bg-neutral-950 hover:bg-neutral-900 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-900 focus:shadow-outline focus:outline-none">
                Submit
            </button>
        </div>
    </form>


    <script>
        function capitalizeTitle(title) {
            return title
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                .join(' ');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const provinceSelect = document.getElementById('province');
            const citySelect = document.getElementById('city');

            fetchProvinces();

            provinceSelect.addEventListener('change', function () {
                const provinceId = this.value;
                if (provinceId) {
                    fetchCities(provinceId);
                } else {
                    citySelect.innerHTML = '<option value="">Select a city</option>';
                }
            });

            function fetchProvinces() {
                fetch('/api/provinces')
                    .then(response => response.json())
                    .then(data => {
                        provinceSelect.innerHTML = '<option value="">Select a province</option>';
                        data.value.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = capitalizeTitle(province.name);
                            provinceSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching provinces:', error));
            }

            function fetchCities(provinceId) {
                fetch(`/api/cities/${provinceId}`)
                    .then(response => response.json())
                    .then(data => {
                        citySelect.innerHTML = '<option value="">Select a city</option>';
                        data.value.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = capitalizeTitle(city.name);
                            citySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching cities:', error));
            }
        });
    </script>
</x-layout>
