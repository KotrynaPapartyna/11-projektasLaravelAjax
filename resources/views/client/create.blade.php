@extends('layouts.app')

@section('content')

        {{--<form action="{{route("client.store")}}" method="POST">
            <input type="text" name="clientName"/>
            <input type="text" name="clientSurname"/>
            <textarea name="clientDescription"></textarea>

            <button type="submit">ADD</button>
        @csrf

        </form>--}}

    <input type="text" name="clientName" id="clientName"/>
    <input type="text" name="clientSurname" id="clientSurname"/>
    <textarea name="clientDescription" id="clientDescription"></textarea>

    <button type="submit" id="add">ADD</button>

    <script>

        // kaip formos apsauga
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#add").click(function() {
            var clientName=$("#clientName").val();
            var clientSurname=$("#clientSurname").val();
            var clientDescription=$("#clientDescription").val();
        console.log("veikia"); // patikrina consoleje ar viskas ok

        //JS masyvas- json

        // vykdoma uzklausa
        $.ajax({
            // tipas
            type: "POST",
            //kelias- nuoroda
            url: "{{route("client.store")}}",
            // perduodami duomenys i back end- turi sutapti su request Controlleryje
            data: {clientName: clientName, clientSurname: clientSurname, clientDescription: clientDescription},
            // sekmes funkcija- ka turi parasyti ir parodyti
            success: function(data) {
                alert(data.success);
            }
        });

        });

    </script>


@endsection
