
@extends('layouts.front')

@section('title')
    Home Page
@endsection

@section('css')
@endsection

@section('content')
    <div class="main-container">
        <div id="news-list-container">
            @include('layouts.sections.front.partials_newlist', ['news' => $news])
        </div>

        <nav class="mt-5">
            <ul id="pagination-container" class="pagination justify-content-center">
                {{ $news->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#news-list-container').html(data.html);
                    $('#pagination-container').html(data.pagination);
                },
                error: function(xhr, status, error) {
                    console.error("Ajax:", error);
                }
            });
        });
    });
</script>
@endsection
