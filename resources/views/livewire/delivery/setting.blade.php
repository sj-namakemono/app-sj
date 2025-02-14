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
      <li>各種設定</li>
    </ul>
  </div>
</x-slot>

<div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">

  <x-form-section submit="editUser">
    <x-slot name="title">
      配送担当者を編集
    </x-slot>

    <x-slot name="description">
      配送担当者の追加、削除ができます。
    </x-slot>

    <x-slot name="form">
      <div class="col-span-6 sm:col-span-4">
        <x-label for="new_user" value="担当者名" />
        <x-input id="new_user" type="text" class="mt-1 block w-full" wire:model="new_user" placeholder=""
          autocomplete="off" />
        <x-input-error for="endpoint" class="mt-2" />
        <div class="mt-4">
          <x-label for="" value="担当者リスト" />
          <div class="col-span-6 mt-1 sm:col-span-4">
            @foreach ($registered_user as $user)
              <div class="flex items-center justify-between border-b p-2">
                <span>{{ $user->name }}</span>
                <button type="button" class="btn btn-circle btn-sm" wire:click="deleteUser({{ $user->id }})">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                  </svg>
                </button>
              </div>
            @endforeach
            @if ($registered_user->isEmpty())
              <span class="text-sm">配送担当者が登録されていません。</span>
            @endif
          </div>
        </div>
      </div>
    </x-slot>

    <x-slot name="actions">
      <button type="submit" class="btn btn-primary">追加</button>
    </x-slot>

  </x-form-section>

  <x-section-border />

  <x-form-section submit="editUrl">
    <x-slot name="title">
      エンドポイント設定
    </x-slot>

    <x-slot name="description">
      teams通知用のurlを設定してください。<br>チャネル＞ワークフロー＞管理
    </x-slot>

    <x-slot name="form">
      <div class="col-span-6 sm:col-span-4">
        <x-label for="endpoint" value="通知url" />
        <x-input id="endpoint" type="text" class="mt-1 block w-full" wire:model="endpoint" autocomplete="off" />
        <x-input-error for="endpoint" class="mt-2" />
      </div>
    </x-slot>

    <x-slot name="actions">
      <button type="submit" class="btn btn-primary">設定</button>
    </x-slot>
  </x-form-section>
</div>
