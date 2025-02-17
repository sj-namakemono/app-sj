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
        <li>依頼フォーム</li>
      </ul>
    </div>
  </x-slot>

  <div class="pb-12 text-sm" x-data="{ toggle: false }">
    <ul class="sticky top-0 z-10 mx-auto hidden w-full bg-base-200/80 py-6 md:steps">
      <li class="@if ($photo) step-primary @endif step">
        <span class="line-clamp-1">画像アップロード</span>
      </li>
      <li class="@if ($departure) step-primary @endif step"><span class="line-clamp-1">引取場所を選択</span>
      </li>
      <li class="@if ($destination) step-primary @endif step"><span class="line-clamp-1">送付先を選択</span>
      </li>
      <li class="@if ($type) step-primary @endif step"><span class="line-clamp-1">種別を選択</span>
      </li>
      @if ($type == 1)
        <li class="@if ($order_checked) step-primary @endif step"><span class="line-clamp-1">受注番号を入力</span>
        </li>
      @endif
      <li class="@if ($product_name) step-primary @endif step"><span class="line-clamp-1">品名を入力</span>
      </li>
      <li class="@if ($name) step-primary @endif step"><span class="line-clamp-1">依頼者名を入力</span>
      </li>
      <li class="step" :class="toggle ? 'step-primary' : ''"><span class="line-clamp-1">入力内容を確認</span></li>
    </ul>
    <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:px-8">
      <form action="" wire:submit="save">
        {{-- 入力フォーム --}}
        <div class="grid gap-8" x-show="!toggle">
          {{-- 写真 --}}
          <div
            class="@if ($photo) border-primary @endif relative flex flex-col items-center justify-center rounded-xl border-2 bg-base-100 p-8 text-gray-500">
            <label for="photo" class="flex w-60 cursor-pointer rounded-full border-2 bg-base-100 md:col-span-1">
              <input type="file" capture="environment" accept="image/*" class="hidden" id="photo"
                wire:model.live="photo" />
              <div class="btn btn-circle btn-primary btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" class="size-8">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                </svg>
              </div>
              <span class="flex flex-grow items-center justify-center text-lg font-bold">カメラを起動</span>
            </label>
            <p class="mt-4 font-bold tracking-wider sm:text-lg" @if ($photo) hidden @endif>
              荷物の写真をアップロードしてください。</p>
            <x-input-error for="photo" class="mt-2" />
            @if ($photo)
              <img src="{{ $photo->temporaryUrl() }}" alt="" class="mt-4 h-40 w-auto">
              <div class="mt-4 flex items-center gap-4">
                <span class="text-lg">荷物点数</span>
                <select class="select select-bordered w-fit border-2" wire:model="count">
                  @for ($i = 1; $i <= 15; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>

              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                class="absolute right-4 top-4 ml-2 size-8 text-primary" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                  clip-rule="evenodd" />
              </svg>
            @endif
          </div>
          @if ($photo)
            {{-- 引取場所 --}}
            <div class="">
              <p class="mb-4 flex items-center font-bold sm:text-xl">
                引取場所を選択してください
                @if ($departure)
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                      clip-rule="evenodd" />
                  </svg>
                @endif
              </p>
              <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                <div class="">
                  <input class="peer hidden" type="radio" name="departure" id="departure.1" value="本社"
                    wire:model.live="departure">
                  <label for="departure.1"
                    class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                    <p class="text-sm font-bold sm:text-xl">本社</p>
                  </label>
                </div>
                <div class="">
                  <input class="peer hidden" type="radio" name="departure" id="departure.2" value="笹井"
                    wire:model.live="departure">
                  <label for="departure.2"
                    class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                    <p class="text-sm font-bold sm:text-xl">笹井</p>
                  </label>
                </div>
                <div class="">
                  <input class="peer hidden" type="radio" name="departure" id="departure.3" value="日高"
                    wire:model.live="departure">
                  <label for="departure.3"
                    class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                    <p class="text-sm font-bold sm:text-xl">日高</p>
                  </label>
                </div>
              </div>
            </div>
            {{-- 送付先 --}}
            <div class="">
              <p class="mb-4 flex items-center font-bold sm:text-xl">
                送付先を選択してください
                @if ($destination)
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                      clip-rule="evenodd" />
                  </svg>
                @endif
              </p>
              <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                @if ($departure !== '本社')
                  <div class="">
                    <input class="peer hidden" type="radio" name="destination" id="destination.1" value="本社"
                      wire:model.live="destination">
                    <label for="destination.1"
                      class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                      <p class="text-sm font-bold sm:text-xl">本社</p>
                    </label>
                  </div>
                @endif
                @if ($departure !== '笹井')
                  <div class="">
                    <input class="peer hidden" type="radio" name="destination" id="destination.2" value="笹井"
                      wire:model.live="destination">
                    <label for="destination.2"
                      class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                      <p class="text-sm font-bold sm:text-xl">笹井</p>
                    </label>
                  </div>
                @endif
                @if ($departure !== '日高')
                  <div class="">
                    <input class="peer hidden" type="radio" name="destination" id="destination.3" value="日高"
                      wire:model.live="destination">
                    <label for="destination.3"
                      class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                      <p class="text-sm font-bold sm:text-xl">日高</p>
                    </label>
                  </div>
                @endif
              </div>
            </div>
            {{-- 種別 --}}
            <div class="">
              <p class="mb-4 flex items-center font-bold sm:text-xl">
                種別を選択してください
                @if ($type)
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                      clip-rule="evenodd" />
                  </svg>
                @endif
              </p>
              <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                <div class="">
                  <input class="peer hidden" type="radio" name="type" id="type.1" value="1"
                    wire:model.live="type">
                  <label for="type.1"
                    class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                    <p class="text-sm font-bold sm:text-xl">下版関連</p>
                  </label>
                </div>
                <div class="">
                  <input class="peer hidden" type="radio" name="type" id="type.2" value="2"
                    wire:model.live="type">
                  <label for="type.2"
                    class="flex h-16 cursor-pointer items-center justify-center rounded-xl bg-base-100 duration-100 peer-checked:outline-none peer-checked:ring-2 peer-checked:ring-primary peer-checked:ring-offset-2 sm:h-24">
                    <p class="text-sm font-bold sm:text-xl">その他</p>
                  </label>
                </div>
              </div>
            </div>
            {{-- 受注番号 --}}
            @if ($type == 1)
              <div class="">
                <p class="mb-4 flex items-center font-bold sm:text-xl">
                  受注番号を入力してください
                  @if ($order_checked)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                      fill="currentColor">
                      <path fill-rule="evenodd"
                        d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                        clip-rule="evenodd" />
                    </svg>
                  @endif
                </p>
                <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                  <input type="text" autocomplete="off" placeholder=""
                    class="input input-bordered col-span-full md:col-span-2" wire:model.live="order_number" />
                </div>
              </div>
            @endif
            {{-- 品名 --}}
            <div class="">
              <p class="mb-4 flex items-center font-bold sm:text-xl">
                品名を入力してください
                @if ($product_name)
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                      clip-rule="evenodd" />
                  </svg>
                @endif
              </p>
              <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                <input type="text" autocomplete="off" placeholder=""
                  class="input input-bordered col-span-full md:col-span-2"
                  wire:model.live.debounce.300ms="product_name" />
              </div>
            </div>
            {{-- 依頼者名 --}}
            <div class="">
              <p class="mb-4 flex items-center font-bold sm:text-xl">
                依頼者名を入力してください
                @if ($name)
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="ml-2 size-7 text-primary"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                      clip-rule="evenodd" />
                  </svg>
                @endif
              </p>
              <div class="grid grid-cols-3 gap-4 sm:gap-8 lg:grid-cols-4">
                <input type="text" autocomplete="off" placeholder=""
                  class="input input-bordered col-span-full md:col-span-2" wire:model.live.debounce.300ms="name" />
              </div>
            </div>
            {{-- ボタンアクション --}}
            @if ($standBy)
              <div class="">
                <button type="button" @click="toggle = true"
                  class="btn btn-primary btn-lg tracking-wider">入力内容を確認</button>
                <a href="{{ route('delivery.overview') }}" type="button"
                  class="btn btn-neutral btn-lg ml-4 tracking-wider">キャンセル</a>
              </div>
            @endif
          @endif
        </div>
        {{-- 確認画面 --}}
        <div class="mt-4 grid gap-4" x-show="toggle" x-cloak>
          <div class="card bg-base-100 shadow-xl lg:card-side">
            @if ($photo)
              <figure class="p-4 lg:w-1/2">
                <img src="{{ $photo->temporaryUrl() }}" alt="image" class="h-60 w-auto rounded-md">
              </figure>
            @endif
            <div class="card-body">
              <h2 class="card-title">以下の内容で送信します</h2>
              <div class="my-4">
                <div class="flex items-center gap-2">
                  <kbd class="kbd kbd-lg">{{ $departure }}</kbd>
                  >>>
                  <kbd class="kbd kbd-lg">{{ $destination }}</kbd>
                </div>
                <div class="mt-2 grid gap-1 text-lg font-bold">
                  <div class="">
                    種別：{{ $type == 1 ? '下版関連' : 'その他' }}
                  </div>
                  @if ($order_number)
                    <div class="">受注番号：{{ $order_number }}</div>
                  @endif
                  <div class="">品名：{{ $product_name }}</div>
                  <div class="">個数：{{ $count }}</div>
                  <div class="">依頼者名：{{ $name }}</div>
                </div>
              </div>
              <div class="card-actions justify-end">
                <button type="submit" class="btn btn-primary">送信</button>
                <button type="button" @click="toggle = false" class="btn btn-neutral ml-4">依頼内容を修正</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
