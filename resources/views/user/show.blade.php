<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          商品の詳細
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                  <div class="md:flex md:justify-around">
                    <div class="md:w-1/2">
                      <x-thumbnail filename="{{  $product->imageFirst->filename ?? '' }}" type="products" />
                    </div>
                    <div class="md:w-1/2 ml-4">
                      <div class="text-sm mb-4 title-font text-gray-500 tracking-widest">{{ $product->category->name }}</div>
                      <div class="text-gray-900 text-3xl mb-4 title-font font-medium">{{ $product->name }}</div>
                      <p class="leading-relaxed mb-4">{{ $product->information }}</p>
                      <div class="flex justify-around items-center">
                        <div>
                          <span class="title-font font-medium text-2xl text-gray-900">{{ number_format($product->price) }}</span>
                          <span class="text-sm text-gray-700">円（税込）</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-3">数量</span>
                            <div class="relative">
                              <select class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                <option>SM</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                              </select>
                            </div>
                        </div>
                        
                        <button class="flex text-white bg-rose-700 border-0 py-2 px-6 focus:outline-none hover:bg-rose-800 rounded">カートに入れる</button>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
