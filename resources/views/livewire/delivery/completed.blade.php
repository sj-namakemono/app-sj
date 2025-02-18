  <x-slot name="header">
    <div class="breadcrumbs text-sm">
      <ul>
        <li>
          <a href="/" wire:navigate>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
              <path
                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
              <path
                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
            </svg>
          </a>
        </li>
        <li><a href="{{ route('delivery.index') }}" wire:navigate>社内便</a></li>
        <li>配達済みリスト</li>
      </ul>
    </div>
  </x-slot>

  <div class="py-12 text-sm" x-data="{ search: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      {{-- テーブルレイアウト --}}
      <div class="rounded-lg border shadow-xl">
        {{-- テーブルボタン --}}
        <div class="flex items-center justify-between rounded-t-lg bg-base-100 p-4">
          <div class="flex gap-3">
            <a href="{{ route('delivery.index') }}" wire:navigate>
              <x-secondary-button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="mr-1 size-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                閉じる
              </x-secondary-button>
            </a>
            <x-secondary-button @click="search = !search"
              x-bind:class="search ? 'ring-2 ring-primary ring-offset-2' : 'ring-0'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mr-2 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
              検索
            </x-secondary-button>
          </div>
          <a href="{{ route('delivery.create') }}" wire:navigate>
            <x-button>
              社内便を依頼
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ml-2 size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
            </x-button>
          </a>
        </div>
        {{-- 検索 --}}
        <div class="grid gap-4 border-y p-4" x-show="search" x-cloak>
          <div class="w-fit">
            <x-label for="" value="依頼完了日" />
            <div class="mt-2 grid gap-4 md:grid-cols-3">
              <div class="flex items-center gap-2">
                <label class="form-control w-full max-w-xs">
                  <select class="select select-bordered" wire:model="selected_year">
                    <option value="" disabled></option>
                    @foreach ($years as $year)
                      <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                  </select>
                </label>
                年
              </div>
              <div class="flex items-center gap-2">
                <label class="form-control w-full max-w-xs">
                  <select class="select select-bordered" wire:model="selected_month">
                    <option value="" disabled></option>
                    @foreach ($months as $month)
                      <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                  </select>
                </label>
                月
              </div>
            </div>
          </div>
          <div class="max-w-lg">
            <x-label for="search_number" value="受注番号" />
            <x-input id="search_number" type="text" class="mt-2 block w-full" wire:model="order_number"
              placeholder="" autocomplete="off" />
          </div>
          <div class="max-w-lg">
            <x-label for="search_product" value="品名" />
            <x-input id="search_product" type="text" class="mt-2 block w-full" wire:model="product_name"
              placeholder="" autocomplete="off" />
          </div>
          <div class="max-w-lg">
            <x-label for="search_person" value="配達担当者" />
            <div class="mt-2 flex items-center gap-2">
              <label class="form-control w-full max-w-xs">
                <select class="select select-bordered" wire:model="delivery_person">
                  <option value="" disabled></option>
                  @foreach ($registered_user as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach
                </select>
              </label>
            </div>
          </div>
          <div class="flex gap-2">
            <x-button wire:click="searchRecord">検索</x-button>
            <x-secondary-button wire:click="searchClear">検索条件をクリア</x-secondary-button>
            <x-secondary-button @click="search = !search">閉じる</x-secondary-button>
          </div>
        </div>
        {{-- テーブル --}}
        <div class="overflow-x-scroll rounded-b-lg bg-base-100">
          <table class="table min-w-full">
            <thead class="bg-base-200">
              <tr>
                <th scope="col" class="whitespace-nowrap">
                  依頼日
                </th>
                <th scope="col" class="whitespace-nowrap">
                  品名
                </th>
                <th scope="col" class="whitespace-nowrap">
                  個数
                </th>
                <th scope="col" class="whitespace-nowrap">
                  出発
                </th>
                <th scope="col" class="whitespace-nowrap">
                  送付先
                </th>
                <th scope="col" class="whitespace-nowrap">
                  配達担当者
                </th>
                <th scope="col" class="whitespace-nowrap">
                  出発日時
                </th>
                <th scope="col" class="whitespace-nowrap">
                  到着日時
                </th>
                <th scope="col" class="whitespace-nowrap">
                  受け取り日時
                </th>
                <th scope="col" class="whitespace-nowrap"></th>
              </tr>
            </thead>
            <tbody class="">
              @if ($records->isNotEmpty())
                @foreach ($records as $key => $record)
                  <tr class="">
                    <td class="whitespace-nowrap">
                      {{ $record->created_at->format('Y/m/d') }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ $record->product_name }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ $record->count }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ $record->departure }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ $record->destination }}
                    </td>
                    <td class="whitespace-nowrap">
                      {{ $record?->deliveryPeople->name ?? '-' }}
                    </td>
                    {{-- 出発時間 --}}
                    <td class="whitespace-nowrap">
                      {{ $record->departure_datetime->format('Y/m/d H:i') }}
                    </td>
                    {{-- 到着時間 --}}
                    <td class="whitespace-nowrap">
                      {{ $record->arrival_datetime->format('Y/m/d H:i') }}
                    </td>
                    {{-- 受け取り日時 --}}
                    <td class="whitespace-nowrap">
                      {{ $record->receipt_datetime->format('Y/m/d H:i') }}
                    </td>
                    {{-- ボタン --}}
                    <td class="whitespace-nowrap">
                      <button class="btn btn-circle" onclick="show_modal_{{ $key }}.showModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                          stroke-width="1.5" stroke="currentColor" class="size-5">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                      </button>
                      <dialog id="show_modal_{{ $key }}" class="modal">
                        <div class="modal-box">
                          <figure class="flex items-center justify-center">
                            <img src="{{ asset('storage/' . $record->file->file_path) }}" alt=""
                              class="h-60 w-auto">
                          </figure>
                          <div class="modal-action">
                            <form method="dialog">
                              <button class="btn">Close</button>
                            </form>
                          </div>
                        </div>
                      </dialog>
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td>
                    <span>配達履歴がありません。</span>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      {{-- pagination --}}
      <div class="mt-4 flex items-center justify-between">
        {{ $records->links(data: ['scrollTo' => false]) }}
        <select class="select select-bordered w-20 max-w-xs" wire:model.live="num">
          @foreach ($num_list as $value)
            <option value="{{ $value }}">{{ $value }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
