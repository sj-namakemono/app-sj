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
       <li><a href="{{ route('delivery.overview') }}" wire:navigate>依頼リスト</a></li>
       <li>編集</li>
     </ul>
   </div>
 </x-slot>

 <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
   <x-form-section submit="editRecord">
     <x-slot name="title">
       依頼を編集
     </x-slot>

     <x-slot name="description">
       基本情報（依頼日 / 画像 / 品名 / 出発地 / 送付先）の編集はできません。<br>基本情報を修正したい場合はこの依頼を削除し、再度申請を行ってください。
     </x-slot>

     <x-slot name="form">
       <figure class="col-span-3">
         <img src="{{ asset('storage/' . $this->record->file->file_path) }}" alt="" class="h-60 w-auto">
       </figure>
       <details
         class="col-span-full cursor-pointer rounded-lg border border-base-300 bg-base-200 p-4 text-sm sm:col-span-4">
         <summary>基本情報</summary>
         <div class="col-span-6 mt-4 sm:col-span-4">
           <div class="grid gap-2">
             <div class="">
               <x-label for="" value="依頼日" />
               <x-input id="" type="text" class="mt-1 block w-full" placeholder=""
                 value="{{ $record->created_at->format('Y/m/d') }}" autocomplete="off" readonly />
             </div>
             <div class="">
               <x-label for="" value="品名" />
               <x-input id="" type="text" class="mt-1 block w-full" placeholder=""
                 value="{{ $record->product_name }}" autocomplete="off" readonly />
             </div>
             <div class="flex gap-4">
               <div class="">
                 <x-label for="" value="出発地" />
                 <x-input id="" type="text" class="mt-1 block w-full" placeholder=""
                   value="{{ $record->departure }}" autocomplete="off" readonly />
               </div>
               <div class="">
                 <x-label for="" value="送付先" />
                 <x-input id="" type="text" class="mt-1 block w-full" placeholder=""
                   value="{{ $record->destination }}" autocomplete="off" readonly />
               </div>
             </div>
           </div>
         </div>
       </details>
       <div class="col-span-full mt-2 grid gap-4">
         <div class="">
           <x-label value="配送担当者"></x-label>
           <label class="form-control mt-1 w-full max-w-xs">
             <select class="select select-bordered" wire:model="selected_user">
               <option value="" disabled></option>
               @foreach ($registered_user as $user)
                 <option value="{{ $user->id }}">{{ $user->name }}</option>
               @endforeach
             </select>
           </label>
           <div class="mt-2 flex gap-2">
             <a href="{{ route('delivery.setting') }}" wire:navigate>
               <x-secondary-button>配送担当者を追加</x-secondary-button>
             </a>
             <x-secondary-button wire:click="clearSelectedUser">クリア</x-secondary-button>
           </div>
           <x-input-error for="selected_user" class="mt-2" />
         </div>
         <div class="">
           <x-label for="" value="出発日時" />
           <x-input-error for="selected_departure_year" class="mt-2" />
           <div class="mt-2 flex flex-wrap gap-4">
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_departure_year">
                   <option value="" disabled></option>
                   @foreach ($years as $year)
                     <option value="{{ $year }}">{{ $year }}</option>
                   @endforeach
                 </select>
               </label>
               年
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_departure_month">
                   <option value="" disabled></option>
                   @foreach ($months as $month)
                     <option value="{{ $month }}">{{ $month }}</option>
                   @endforeach
                 </select>
               </label>
               月
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_departure_day">
                   <option value="" disabled></option>
                   @foreach ($days as $day)
                     <option value="{{ $day }}">{{ $day }}</option>
                   @endforeach
                 </select>
               </label>
               日
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_departure_hour">
                   <option value="" disabled></option>
                   @foreach ($hours as $hour)
                     <option value="{{ $hour }}">{{ $hour }}</option>
                   @endforeach
                 </select>
               </label>
               時
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_departure_minute">
                   <option value="" disabled></option>
                   @foreach ($minutes as $minute)
                     <option value="{{ $minute }}">{{ $minute }}</option>
                   @endforeach
                 </select>
               </label>
               分
             </div>
           </div>
           <div class="mt-2 flex gap-2">
             <x-secondary-button type="button" wire:click="setDepartureDatetime">現在の時刻を入力</x-secondary-button>
             <x-secondary-button type="button" wire:click="clearDepartureDatetime">クリア</x-secondary-button>
           </div>
         </div>
         <div class="">
           <x-label for="" value="到着日時" />
           <div class="mt-2 flex flex-wrap gap-4">
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_arrival_year">
                   <option value="" disabled></option>
                   @foreach ($years as $year)
                     <option value="{{ $year }}">{{ $year }}</option>
                   @endforeach
                 </select>
               </label>
               年
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_arrival_month">
                   <option value="" disabled></option>
                   @foreach ($months as $month)
                     <option value="{{ $month }}">{{ $month }}</option>
                   @endforeach
                 </select>
               </label>
               月
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_arrival_day">
                   <option value="" disabled></option>
                   @foreach ($days as $day)
                     <option value="{{ $day }}">{{ $day }}</option>
                   @endforeach
                 </select>
               </label>
               日
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_arrival_hour">
                   <option value="" disabled></option>
                   @foreach ($hours as $hour)
                     <option value="{{ $hour }}">{{ $hour }}</option>
                   @endforeach
                 </select>
               </label>
               時
             </div>
             <div class="flex items-center gap-2">
               <label class="form-control w-24">
                 <select class="select select-bordered" wire:model="selected_arrival_minute">
                   <option value="" disabled></option>
                   @foreach ($minutes as $minute)
                     <option value="{{ $minute }}">{{ $minute }}</option>
                   @endforeach
                 </select>
               </label>
               分
             </div>
           </div>
           <div class="mt-2 flex gap-2">
             <x-secondary-button type="button" wire:click="setArrivalDatetime">現在の時刻を入力</x-secondary-button>
             <x-secondary-button type="button" wire:click="clearArrivalDatetime">クリア</x-secondary-button>
           </div>
         </div>
       </div>
     </x-slot>

     <x-slot name="actions">
       <a href="{{ route('delivery.overview') }}" wire:navigate>
         <button type="button" class="btn btn-neutral mr-2">キャンセル</button>
       </a>
       <button type="submit" class="btn btn-primary">編集</button>
     </x-slot>

   </x-form-section>
 </div>
