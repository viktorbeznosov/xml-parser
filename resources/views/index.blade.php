@extends('.layouts.site')

@section('content')
  <div class="container">
    <form class="" action="{{ route('show')}}" method="get">
        <div class="wrapper">
          <div class="item">
            <div class="">
              <input type="text" name="name" value="" placeholder="Имя">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="{{ route('show', ['sort' => 'nameAsc'])}}" class="">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="javascript:void(0)" class="">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
              </a>
            </div>

          </div>
          <div class="item">
            <div class="">
              <input type="text" name="age" value="" placeholder="Возраст">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="javascript:void(0)" class="">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="javascript:void(0)" class="">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="">
              <input type="text" name="city" value="" placeholder="Город">
            </div>
            <div class="sort-wrapper">
              <a class="sort" href="javascript:void(0)" class="">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
              </a>
              <a class="sort" href="javascript:void(0)" class="">
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
                    <a href="javascript:void(0)">{{ $client->phone_numbers_shirt() }}</a>
                </div>
            </div>
        @endforeach
        <input type="submit" name="" value="Найти">
    </form>
  </div>

<style media="screen">
  .wrapper {
      display: grid;
      grid-template-columns: 25% 25% 25% 25%;
      grid-template-rows: 100px;
      border: 1px solid #cccccc;
  }

    @media (max-width: 800px) {
      .wrapper {
          display: grid;
          grid-template-columns: 50% 50%;
          grid-template-rows: 100px 100px;
      }
    }

    @media (max-width: 600px) {
      .wrapper {
          display: grid;
          grid-template-columns: 100%;
          grid-template-rows: 100px 100px 100px 100px;
      }
    }
</style>

@endsection
