@extends('admin.layouts.main')

@push('css')
<!-- SimpleMDE css -->
  <link rel="stylesheet" href="{{ asset('admin/css/colorbox.css') }}">
@endpush

@section('title', 'Довавить меню')




@section('content')                                                 
               


<div class="content-page">
  <div class="content">
      <!-- Start Content-->
      <div class="container-fluid">

          <!-- start page title -->
          <div class="row mb-3">
            <div class="col-12">
              <div class="card-block p-3 mt-3" style="background: #fff" >
                <div class="card-body d-flex justify-content-between align-items-center">
                  <h4 class="card-title">Ҳәмме итемлар</h4>
                </div>
              </div>
            </div>
          </div>
          <!-- start page title -->
          <div class="row mb-3">
            <div class="col-12">
              <h5>Итемлар дүзилиси</h5>
              <form action="{{route('dashboard.children.store')}}" method="post">
                <div class="card-block p-2" style="background: #fff" >
                  @forelse ($menu_items as $m => $menu_item)
                    <div class="accordion " id="accordionFlushExample{{$menu_item->id}}">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#flush-collapseOne{{$menu_item->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$menu_item->id}}">
                                  {{$menu_item->menu->item->name_qr}} -> {{$menu_item->item->name_qr}} 
                              </button>
                          </h2>
                            @csrf
                            <div id="flush-collapseOne{{$menu_item->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                data-bs-parent="#accordionFlushExample{{$menu_item->id}}">
                                <div class="accordion-body">
                                  @forelse ($items as $i => $item)
                                    {{-- @if($menu_item->item->id!=$item->id && $menu_item->menu->item->id != $item->id) --}}
                                    @if(!in_array($item->id, json_decode(json_encode($menu_items->pluck('item_id'))), true) && !in_array($item->id, json_decode(json_encode($menus->pluck('item_id')))))
                                      @if (in_array($item->id, json_decode(json_encode($childrens->where('menu_item_id',$menu_item->id)->pluck('item_id'))), true))
                                        <div class="row">
                                          <div class="col-sm-8  form-check">
                                            <input type="checkbox" checked name="childrens[{{$menu_item->id}}][]" value="{{$item->id}}" class="form-check-input" id="check{{$item->id}}">
                                            <label class="form-check-label" for="check{{$item->id}}">{{$item->name_qr}}</label>
                                          </div>
                                        </div>
                                        @else
                                        <div class="row">
                                          <div class="col-sm-8 form-check">
                                            <input type="checkbox"  name="childrens[{{$menu_item->id}}][]" value="{{$item->id}}" class="form-check-input" id="check{{$item->id}}">
                                            <label class="form-check-label" for="check{{$item->id}}">{{$item->name_qr}}</label>
                                          </div>
                                        </div>
                                      @endif
                                    @endif
                                  @empty
                                  <span class="d-flex justify-content-center alert alert-danger">Бетлер жоқ</span>
                                  @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                  @empty
                  <span class="d-flex justify-content-center alert alert-danger w-100">Меню жоқ</span>
                  @endforelse
                  <button class="btn btn-sm btn-primary mt-2 <?=(count($menu_items)>0) ? 'd-flex' : 'd-none';?>">Итемди сақлаў</button>
                </div>
              </form>
              </div>
            </div>
          </div>
        <!-- end page title -->
             

    </div> <!-- container -->

  </div> <!-- content -->
</div>

         
@endsection
