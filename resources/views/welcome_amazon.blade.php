@foreach ($amazon as $user)
    <tr>
        <td>
           <img src="{{ $user['img']}}"> 
        </td>
        <td style=" word-wrap: break-word;">
        {{$user['title']}}
        </td>
        <td>
            {{$user['price']}}
        </td>
        <td>
          {{$user['seller']}}
        </td>
    </tr>
@endforeach