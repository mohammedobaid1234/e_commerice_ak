<td class="v-align-middle wd-10p" > <span id="label-{{$row->id}}" class="badge badge-pill badge-{{($row->status == "active")
    ? "info" : "danger"}}" id="label-{{$row->id}}">

    {{__($row->status)}}
</span>
</td>