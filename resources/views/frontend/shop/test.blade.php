  <!-- Header Section Begin -->
  @include('frontend.components.header')
  <!-- Header Section End -->
  <table class="table">
      <tr>
          <th>name</th>
          <th>quantity</th>
          <th>Acion</th>
      </tr>
      @foreach ($products as $item)
          <tr>
              <form action="{{url('/add-to-cart')}}" method="POST">
                @csrf
                <td>{{ $item->name }}</td>
                  <td><input type="number" name="quantity">

                <input type="hidden" name="item_id" value="{{$item->id}}"></td>
                  <td>
                      <button type="submit">Add to cart</button>
                  </td>
              </form>
          </tr>
      @endforeach
  </table>
  <!-- Header Section Begin -->
  @include('frontend.components.footer')
  <!-- Header Section End -->
