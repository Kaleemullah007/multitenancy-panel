<div class="card-body">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('contact.table.reply_to') }}</th>
                <th scope="col">{{ __('contact.table.reply_to_email') }} </th>
                <th scope="col">{{ __('contact.table.message') }}</th>
                <th scope="col">{{ __('contact.table.reply_message') }}</th>
                <th scope="col">{{ __('contact.table.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @if ($replies->count() > 0)
                @php
                    $counter = 1;
                @endphp
                @foreach ($replies as $reply)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $reply->receiver->name }}</td>
                        <td>{{ $reply->receiver->email }}</td>
                        <td>{{ $reply->receiver->message }}</td>
                        <td>{{ $reply->message }}</td>
                        <td>{{ $reply->created_at?->diffForHumans() }}</td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">{{ __('general.no-record') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
