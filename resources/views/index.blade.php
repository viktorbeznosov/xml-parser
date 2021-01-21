@extends('.layouts.site')

@section('content')
  <div class="container">
    @if (count($clients) > 0)
    <form class="" action="{{ route('show')}}" method="get">
        <div class="wrapper">
          <div class="item">
            <div class="">
              <input type="text" name="name" value="" placeholder="Имя">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="{{ route('sort', ['type' => 'nameAsc'])}}" class="" title="Отсортировать по имени">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="{{ route('sort', ['type' => 'nameDesc'])}}" class="" title="Отсортировать по имени">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
              </a>
            </div>

          </div>
          <div class="item">
            <div class="">
              <input type="text" name="age" value="" placeholder="Возраст">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="{{ route('sort', ['type' => 'ageAsc'])}}" class="" title="Отсортировать по возрасту">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="{{ route('sort', ['type' => 'ageDesc'])}}" class="" title="Отсортировать по возрасту">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="">
              <input type="text" name="city" value="" placeholder="Город">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="{{ route('sort', ['type' => 'cityAsc'])}}" class="" title="Отсортировать по городу">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="{{ route('sort', ['type' => 'cityDesc'])}}" class="" title="Отсортировать по городу">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="item">
              <!-- <input type="text" name="phone" value="" placeholder="Телефон"> -->
          </div>
        </div>

        @foreach($clients as $client)
            <div class="wrapper">
                <div class="item">
                    {{ $client->name }}
                </div>
                <div class="item">
                    {{ $client->age }}
                </div>
                <div class="item">
                    {{ $client->city }}
                </div>
                <div class="item phone">
                    <a href="javascript:void(0)"  data-toggle="modal" data-target="#exampleModal{{ $client->id }}" title="Номера телефонов">{{ $client->phone_numbers_shirt() }}</a>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Номера телефонов</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @foreach($client->phone_numbers()->get() as $item)
                      <div class="">
                        <a href="tel:{{ $item->number }}">{{ $item->number }}</a>
                      </div>
                    @endforeach
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
        <input class="btn btn-secondary" type="submit" name="" value="Найти">

        @if (isset($search) && $search == true)
          <a href="{{ route('show') }}" type="button" class="back btn btn-primary">Назад</a>
        @endif
    </form>
    @else
      <h1>Список клиентов пуст</h1>
      @if ($count > 0)
        <a href="{{ route('show') }}" type="button" class="back btn btn-primary">Назад</a>
      @endif
    @endif
  </div>

@endsection
