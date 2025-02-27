@if (!empty($recipe->image) && json_decode($recipe->image))
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach (json_decode($recipe->image) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="レシピ画像" 
                                            class="w-full h-48 object-cover rounded-md cuser-pointer"
                                            onclick="openModal('{{ asset('storage/' . $image) }}')">
                                    @endforeach
                                </div>
                            @endif