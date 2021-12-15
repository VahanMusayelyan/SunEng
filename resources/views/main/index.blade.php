@extends("layout")

@section("content")
    <style>
        #admin{
            padding: 20px;
        }
    </style>
    <div id="admin">
        <AdminApp></AdminApp>
    </div>


        <script src="{{mix("/js/admin.js")}}"></script>
@endsection
