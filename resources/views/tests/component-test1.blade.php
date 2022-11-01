<x-tests.app>
  <x-slot name="header">
    ヘッター1です
  </x-slot>
  コンポーネント1
  <x-tests.card title="タイトル1です" content="本文" :message="$message" />
  <x-tests.card title="タイトル2です" />
  <x-tests.card title="CSSを変更したい" class="bg-red-300" />
  <x-slot name="footer">
    フッター1です
  </x-slot>
  
</x-tests.app>