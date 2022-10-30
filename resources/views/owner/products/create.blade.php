<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                 <form method="POST" action="{{ route('owner.products.store') }}">
                    @csrf
                    <div class="-m-2">
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                          <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="information" class="leading-7 text-sm text-gray-600">商品情報</label>
                          <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('information') }}</textarea>
                          <x-input-error :messages="$errors->get('information')" class="mt-2" />
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="price" class="leading-7 text-sm text-gray-600">価格</label>
                          <input type="number" id="price" name="price" value="{{ old('price') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="quantity" class="leading-7 text-sm text-gray-600">初期在庫</label>
                          <input type="number" id="price" name="quantity" value="{{ old('quantity') }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                          <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative">
                          <label for="shop_id" class="leading-7 text-sm text-gray-600">販売する店舗</label>
                          <select name="shop_id" id="shop_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @foreach ($shops as $shop)
                              <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="p-2 w-1/2 mx-auto">
                          <div class="relative">
                            <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                            <select name="category" id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                              @foreach ($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                  @foreach ($category->secondary as $secondary)
                                    <option value={{ $secondary->id }}>{{ $secondary->name }}</option>
                                  @endforeach
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <x-select-image :images="$images" name="image1"/>
                      <x-select-image :images="$images" name="image2"/>
                      <x-select-image :images="$images" name="image3"/>
                      <x-select-image :images="$images" name="image4"/>
                      <div class="p-2 w-1/2 mx-auto">
                        <div class="relative flex justify-around">
                            <div>
                                <input type="radio" name="is_selling" value="1" class="mr-2" checked {{ old('is_selling') === '1' ? 'checked' : '' }}>販売中
                            </div>
                            <div>
                                <input type="radio" name="is_selling" value="0" class="mr-2" {{ old('is_selling') === '0' ? 'checked' : '' }} >停止中
                            </div>
                        </div>
                      </div>
                      
                      <div class="p-2 w-full flex justify-around mt-4">
                          <button type="button" onclick="location.href='{{ route('owner.products.index') }}'" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                          <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                      </div>
                    </div>
                 </form>
              </div>
          </div>
      </div>
  </div>
  <script>
    'use strict'
    const images = document.querySelectorAll('.image')
    
    images.forEach(image => {
      image.addEventListener('click', function(e) {
        const imageName = e.target.dataset.id.substr(0, 6)
        const imageId = e.target.dataset.id.replace(imageName + '_', '')
        const imageFile = e.target.dataset.file
        const imagePath = e.target.dataset.path
        const modal = e.target.dataset.modal
  
        // サムネイルと input type=hiddenのvalueに設定
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
        document.getElementById(imageName + '_hidden').value = imageId
      })
    })
  </script>
</x-app-layout>
