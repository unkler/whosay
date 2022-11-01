<x-tests.app>
  <x-slot name="header">
    ヘッター2です
  </x-slot>
  コンポーネント2
  <x-test-class-base classBaseMessage="メッセージです" />
  <div class="mb-4"></div>
  <x-test-class-base classBaseMessage="メッセージです" defaultMessage="変更後" />
  <x-slot name="footer">
    フッター2です
  </x-slot>
  
</x-tests.app>