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
        <li>社内便</li>
      </ul>
    </div>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 md:grid-cols-2 md:px-6">
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">依頼リスト</h2>
          <p>受付中の依頼を表示します。</p>
          <div class="card-actions justify-end">
            <a role="button" class="btn btn-primary" href="{{ route('delivery.overview') }}" wire:navigate>開く</a>
          </div>
        </div>
      </div>
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">依頼フォーム</h2>
          <p>社内便を依頼します。</p>
          <div class="card-actions justify-end">
            <a role="button" href="{{ route('delivery.create') }}" class="btn btn-primary" wire:navigate>開く</a>
          </div>
        </div>
      </div>
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">履歴</h2>
          <p>過去の依頼を確認できます。</p>
          <div class="card-actions justify-end">
            <a role="button" class="btn btn-primary" href="{{ route('delivery.completed') }}" wire:navigate>開く</a>
          </div>
        </div>
      </div>
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          <h2 class="card-title">各種設定</h2>
          <p>teams通知url、定期便担当者を編集します。</p>
          <div class="card-actions justify-end">
            <a role="button" href="{{ route('delivery.setting') }}" class="btn btn-primary" wire:navigate>開く</a>
          </div>
        </div>
      </div>
    </div>
  </div>
