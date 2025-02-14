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
        <li>依頼リスト</li>
      </ul>
    </div>
  </x-slot>

  <div class="py-12 text-sm" x-data="{ toggle: $wire.entangle('toggle'), search: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      {{-- テーブルレイアウト --}}
      <div class="rounded-lg border shadow-xl">
        {{-- テーブルボタン --}}
        <div class="flex items-center justify-between rounded-t-lg bg-base-100 p-4">
          <div class="flex gap-3">
            <a href="{{ route('delivery.index') }}" wire:navigate>
              <x-secondary-button>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="mr-2 size-5">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                メニュー
              </x-secondary-button>
            </a>
            <x-secondary-button @click="search = !search"
              x-bind:class="search ? 'ring-2 ring-indigo-500 ring-offset-2' : 'ring-0'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mr-2 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
              </svg>
              検索
            </x-secondary-button>
            <x-secondary-button wire:click="$toggle('toggle')"
              x-bind:class="toggle ? 'ring-2 ring-indigo-500 ring-offset-2' : 'ring-0'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="mr-2 size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
              </svg>
              配送履歴を表示
            </x-secondary-button>
          </div>
          <a href="{{ route('delivery.create') }}" wire:navigate>
            <x-button class="">
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
            <x-label for="search_person" value="配送担当者" />
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
                  配送担当者
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
                    <td class="whitespace-nowrap">
                      @if ($record->departure_datetime)
                        {{ $record->departure_datetime->format('Y/m/d H:i') }}
                      @else
                        <button class="btn btn-circle btn-primary w-24"
                          onclick="departure_modal_{{ $key }}.showModal()">
                          出発
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                          </svg>
                        </button>
                        <dialog id="departure_modal_{{ $key }}"
                          class="modal mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                          <div class="modal-box w-4/5 max-w-5xl">
                            <div class="grid gap-4 sm:grid-cols-2">
                              <figure class="flex items-center justify-center">
                                <img src="{{ asset('storage/' . $record->file->file_path) }}" alt=""
                                  class="h-60 w-auto rounded-md object-cover">
                              </figure>
                              <div class="grid gap-4">
                                <h2 class="card-title">出発日時を記録</h2>
                                <p>配送担当者を入力、またはリストから選択してください。</p>
                                <label class="input input-bordered flex items-center gap-2">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="h-4 w-4 opacity-70">
                                    <path
                                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z" />
                                  </svg>
                                  <input type="text" class="input grow border-none" placeholder="Username"
                                    wire:model="new_user" />
                                </label>
                                <div class="max-h-40 overflow-auto rounded-lg">
                                  @foreach ($registered_user as $user)
                                    <div class="form-control rounded-md px-4 hover:bg-base-200">
                                      <label class="label cursor-pointer">
                                        <span class="label-text">{{ $user->name }}</span>
                                        <input type="radio" name="radio-{{ $key }}" class="radio"
                                          wire:model="selected_user" value="{{ $user->id }}" />
                                      </label>
                                    </div>
                                  @endforeach
                                </div>
                                <div class="flex justify-end gap-2">
                                  <form method="dialog">
                                    <button class="btn">キャンセル</button>
                                  </form>
                                  <button class="btn btn-primary"
                                    wire:click="setDeparture({{ $record->id }})">記録</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </dialog>
                      @endif
                    </td>
                    <td class="whitespace-nowrap">
                      @if ($record->arrival_datetime)
                        {{ $record->arrival_datetime->format('Y/m/d H:i') }}
                      @else
                        @if ($record->departure_datetime)
                          <button class="btn btn-circle btn-primary w-24"
                            onclick="destination_modal_{{ $key }}.showModal()">
                            到着
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                              stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                            </svg>
                          </button>
                          <dialog id="destination_modal_{{ $key }}" class="modal">
                            <div class="modal-box w-4/5 max-w-5xl">
                              <div class="grid gap-4 sm:grid-cols-2">
                                <figure class="flex items-center justify-center">
                                  <img src="{{ asset('storage/' . $record->file->file_path) }}" alt=""
                                    class="h-60 w-auto rounded-md object-cover">
                                </figure>
                                <div class="">
                                  <h3 class="text-lg font-bold">到着日時を記録</h3>
                                  <p class="my-4">以下の荷物を配送しました。</p>
                                  <ul class="my-4 rounded-md border p-4 font-bold">
                                    <li>品名：{{ $record->product_name }}</li>
                                    <li>個数：{{ $record->count }}</li>
                                  </ul>
                                  <div class="mt-4 flex justify-end gap-2">
                                    <form method="dialog">
                                      <button class="btn">キャンセル</button>
                                    </form>
                                    <button class="btn btn-primary"
                                      wire:click="setArrival({{ $record->id }})">確認</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </dialog>
                        @else
                          <span>-</span>
                        @endif
                      @endif
                    </td>
                    <td class="whitespace-nowrap">
                      @if ($record->receipt_datetime)
                        {{ $record->receipt_datetime->format('Y/m/d H:i') }}
                      @else
                        @if ($record->arrival_datetime)
                          <button class="btn btn-circle btn-primary w-24"
                            onclick="receipt_modal_{{ $key }}.showModal()">
                            受取
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                              stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672Zm-7.518-.267A8.25 8.25 0 1 1 20.25 10.5M8.288 14.212A5.25 5.25 0 1 1 17.25 10.5" />
                            </svg>
                          </button>
                          <dialog id="receipt_modal_{{ $key }}" class="modal">
                            <div class="modal-box w-4/5 max-w-5xl">
                              <div class="grid gap-4 sm:grid-cols-2">
                                <figure class="flex items-center justify-center">
                                  <img src="{{ asset('storage/' . $record->file->file_path) }}" alt=""
                                    class="h-60 w-auto rounded-md object-cover">
                                </figure>
                                <div class="">
                                  <h3 class="text-lg font-bold">受け取り日時を記録</h3>
                                  <p class="my-4">
                                    以下の荷物を受け取りました。<br>
                                    <span class="text-xs text-red-400">*この操作は取り消せません。必ず手元に荷物があることを確認してください。</span>
                                  </p>
                                  <ul class="my-4 rounded-md border p-4 font-bold">
                                    <li>品名：{{ $record->product_name }}</li>
                                    <li>個数：{{ $record->count }}</li>
                                  </ul>
                                  <div class="flex justify-end gap-2">
                                    <form method="dialog">
                                      <button class="btn">キャンセル</button>
                                    </form>
                                    <button class="btn btn-error"
                                      wire:click="setReceipt({{ $record->id }})">確認</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </dialog>
                        @else
                          <span>-</span>
                        @endif
                      @endif
                    </td>
                    <td class="whitespace-nowrap" :class="toggle ? 'hidden' : 'table-cell'">
                      <div class="flex items-center justify-around">
                        <a href="{{ route('delivery.edit', ['id' => $record->id]) }}" wire:navigate>
                          <button class="btn btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                              stroke-width="1.5" stroke="currentColor" class="size-5">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                          </button>
                        </a>
                        <button class="btn btn-circle" onclick="delete_modal_{{ $key }}.showModal()">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                          </svg>
                        </button>
                        <dialog id="delete_modal_{{ $key }}" class="modal">
                          <div class="modal-box">
                            <h3 class="text-lg font-bold">依頼を削除</h3>
                            <p class="py-4">この操作は取り消せません。本当に削除しますか？</p>
                            <div class="flex justify-end gap-2">
                              <form method="dialog">
                                <button class="btn">キャンセル</button>
                              </form>
                              <button class="btn btn-error"
                                wire:click="deleteRecord({{ $record->id }})">削除</button>
                            </div>
                          </div>
                        </dialog>
                      </div>
                    </td>
                    <td class="whitespace-nowrap" :class="toggle ? 'table-cell' : 'hidden'">
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
                    <span x-show="!toggle">現在受付中の依頼はありません。</span>
                    <span x-show="toggle" x-cloak>配送履歴がありません。</span>
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
