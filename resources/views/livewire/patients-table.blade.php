  <div>
      <section >
          <div class="mx-auto max-w-screen-xl  ">
              <!-- Start coding here -->
              <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                  <div class="flex items-center justify-between d p-4">
                      <div class="flex">
                          <div class="relative w-full">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                      fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd" />
                                  </svg>
                              </div>
                              <input
                                  wire:model.live.debounce.300ms="search"
                                  type="text"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                  placeholder="Search" required="">
                          </div>
                      </div>
                      <div class="flex space-x-3">
                          <div class="flex space-x-3 items-center">
                              <label class="w-40 text-sm font-medium text-gray-900">User Type :</label>
                              <select
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                  <option value="">All</option>
                                  <option value="0">User</option>
                                  <option value="1">Admin</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="overflow-x-auto">
                      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                              <tr>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('id')">ID</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('first_name')">First Name</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('last_name')">Last Name</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('birthdate')">Birthdate</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('age')">Age</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('sex')">Sex</th>
                                  <th scope="col" class="px-4 py-3" >Contact#</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('address')">Address</th>
                                  <th scope="col" class="px-4 py-3" wire:click="setSortBy('registration_date')">Registration Date</th>
                                  <th scope="col" class="px-4 py-3">Details</th>
                                  <th scope="col" class="px-4 py-3">Transactions</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if($patients->isEmpty())
                              <tr>
                                  <td colspan="11" class="text-center py-8">No Patient Records found.</td>
                              </tr>
                              @else
                              @foreach ($patients as $patient)
                              <tr wire:key="{{ $patient->id }}" class="border-b dark:border-gray-700">
                                  <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->id }}</td>
                                  <th
                                      class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                      {{ $patient->first_name }}
                                  </th>
                                  <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->last_name }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->birthdate }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900" >{{ $patient->age }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900" >{{ $patient->sex }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900" >{{ $patient->contact_number }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900" >{{ $patient->address }}</td>
                                  <td class="px-4 py-3 font-medium text-gray-900">{{ $patient->registration_date }}</td>
                                  <td class="px-4 py-3 flex items-center justify-end">
                                      <button class="px-3 py-1 bg-red-500 text-white rounded">X</button>
                                  </td>
                                  <td>Transactions</td>
                              </tr>
                              @endforeach
                              @endif

                          </tbody>
                      </table>


                      </tbody>
                      </table>
                  </div>

                  <div class="py-4 px-3">
                      <div class="flex ">
                          <div class="flex space-x-4 items-center mb-3">
                              <label class="w-32 text-sm font-medium text-gray-900">Per Page</label>
                              <select
                                  wire:model.livewire="perPage"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5 ">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="20">20</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                          </div>
                      </div>
                      {{ $patients->links('vendor.pagination.tailwind') }}
                  </div>
              </div>
          </div>
      </section>

  </div>